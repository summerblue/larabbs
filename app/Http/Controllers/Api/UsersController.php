<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyData = \Cache::get($request->input('verification_key'));

        if(!$verifyData){
            abort(403,'验证码已失效');
        }

        if(!hash_equals($verifyData['code'],$request->input('verification_code'))){
            //返回401
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => $request->password,
        ]);

        //清除验证码缓存
        \Cache::forget($request->input('verification_key'));

        $user->family = [
            'mama' => 'helo',
            'baby' => 'world'
        ];
        return new UserResource($user);
    }
}
