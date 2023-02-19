<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\AuthenticationException;
use App\Models\User;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $cacheKey = 'verificationCodes_'.$request->verification_key;
        $verifyData = Cache::get($cacheKey);
        if(!$verifyData){
            abort(403, '验证码过期');
        }

        if(!hash_equals($verifyData['code'], $request->verification_code)){
            // 返回401
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => $request->password,
        ]);

        //清除验证码缓存
        Cache::forget($cacheKey);

        return new UserResource($user);
    }
}
