<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Redis;

class LoginCheck
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('access_token');
        if (empty($token)) {
            return response()->json(['message' => 'Token不存在'], 401);
        }

        $user = Redis::get($token);
        if (empty($user)) {
            return response()->json(['message' => '尚未登入'], 401);
        }

        $user = json_decode($user);
        $request->merge([
            'user_id'  => $user->id,
            'username' => $user->username
        ]);
        return $next($request);
    }
}
