<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;


class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyData = Cache::get($request->verification_key);
        if (!$verifyData) {
            abort(403, '验证码已失效');
        }
        
        if (!hash_equals($verifyData['code'], $request->verification_code)){
            // 返回401
            throw new AuthenticationException('验证码错误');
        }
        
        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => $request->password,
        ]);
        
        // 清楚缓存
        Cache::forget($request->verification_key);
        
        return new UserResource($user);
    }
}
