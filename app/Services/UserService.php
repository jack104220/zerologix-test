<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use App\Repositories\UserRepository;
use App\Repositories\FollowRepository;
use Exception;

class UserService
{
    const SECRET = 'check';
    const TOKEN_TIME = 7200;

    public function __construct(
        protected UserRepository $userRepo,
        protected FollowRepository $followRepo
    ) {}

    /**
     * 登入
     *
     * @param string $username
     * @param string $passwd
     * @return array|null
     */
    public function login($username, $passwd):array|null
    {
        $user = $this->userRepo->getUserByNameAndPasswd($username, $passwd);
        if (empty($user)) {
            throw new Exception('帳密錯誤');
        }
        
        $token = $this->setLoginToken($user->id, $user->username);
        return ['access_token' =>$token];
    }

    /**
     * 登入token設定
     *
     * @param int|string $id
     * @param string $username
     * @return string
     */
    public function setLoginToken($id, $username):string
    {
        $token = $this->generateToken($username);
        $data = [
            'id' => $id,
            'username' => $username
        ];
        Redis::setex($token, self::TOKEN_TIME, json_encode($data));

        return $token;
    }

    /**
     * 產token
     *
     * @param string $text
     * @return string
     */
    private function generateToken(string $text):string
    {
        return md5($text . time() . self::SECRET);
    }

    /**
     * 登出
     *
     * @param string $token
     * @return array
     */
    public function logout(string $token)
    {
        Redis::del($token);

        return ['message' => 'success'];
    }

    /**
     * 註冊
     *
     * @param string $username
     * @param string $passwd
     * @return array
     */
    public function register(string $username, string $passwd)
    {
        $user = $this->userRepo->getUserByName($username);
        if (!empty($user)) {
            throw new Exception('用戶已存在');
        }

        $data = [
            'username' => $username,
            'passwd' => $passwd
        ];
        $this->userRepo->insert($data);

        return ['message' => 'success'];
    }

    /**
     * 追隨
     *
     * @param int $userId
     * @param int $followerId
     * @return array
     */
    public function follow($userId, $followerId)
    {
        $follower = $this->userRepo->getUserById($followerId);
        if (empty($follower)) {
            throw new Exception('追隨用戶不存在');
        }

        $check = $this->followRepo->getFollowed($userId, $followerId);
        if (empty($check)) {
            $this->followRepo->insert(['user_id' => $userId, 'follower_id' => $followerId]);
            return ['message' => 'followed'];
        }

        $this->followRepo->delFollowed($userId, $followerId);
        return ['message' => 'unfollowed'];
    }

}