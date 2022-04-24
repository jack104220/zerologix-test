<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Exception;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    /**
     * 登入
     *
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'username' => ['required', 'max:64'],
                'passwd' => ['required', 'max:64']
            ]);

            $data = $this->service->login($data['username'], $data['passwd']);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * 登出
     *
     * @param Request $request
     * @return string
     */
    public function logout(Request $request)
    {
        try {
            $token = $request->header('access_token');
            if (empty($token)) {
                throw new Exception('用戶不存在');
            }

            $data = $this->service->logout($token);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * 註冊
     *
     * @param Request $request
     * @return string
     */
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'username' => ['required', 'max:64'],
                'passwd' => ['required', 'max:64']
            ]);

            $data = $this->service->register($data['username'], $data['passwd']);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * 追蹤用戶
     *
     * @param Request $request
     * @return string
     */
    public function follow(Request $request)
    {
        try {
            $data = $request->validate([
                'follower_id' => 'required|numeric|min:1',
            ]);

            return $this->service->follow($request->input('user_id'), $data['follower_id']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

}
