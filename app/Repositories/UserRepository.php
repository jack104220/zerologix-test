<?php

namespace App\Repositories;

use App\Models\Users;

class UserRepository extends BaseRepository
{
    public function __construct(protected Users $model) {}

    /**
     * 帳密找用戶
     *
     * @param string $username
     * @param string $passwd
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getUserByNameAndPasswd(string $username, string $passwd)
    {
        return $this->model
            ->where('username', $username)
            ->where('passwd', $passwd)
            ->first();
    }

    /**
     * 帳號找用戶
     *
     * @param string $username
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getUserByName(string $username)
    {
        return $this->model
            ->where('username', $username)
            ->first();
    }

    /**
     * 尋找用戶id
     *
     * @param integer $userId
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getUserById(int $userId)
    {
        return $this->model->find($userId);
    }
}