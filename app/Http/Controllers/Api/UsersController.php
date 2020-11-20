<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
=======
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Auth\AuthenticationException;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
<<<<<<< HEAD
        $verifyData = \Cache::get($request->input('verification_key'));

        if(!$verifyData){
            abort(403,'验证码已失效');
        }

        if(!hash_equals($verifyData['code'],$request->input('verification_code'))){
            //返回401
=======
        $verifyData = \Cache::get($request->verification_key);

       if (!$verifyData) {
           abort(403, '验证码已失效');
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => $request->password,
        ]);

<<<<<<< HEAD
        //清除验证码缓存
        \Cache::forget($request->input('verification_key'));
=======
        // 清除验证码缓存
        \Cache::forget($request->verification_key);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

        return (new UserResource($user))->showSensitiveFields();
    }

<<<<<<< HEAD
    public function show(User $user)
=======
    public function show(User $user, Request $request)
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    {
        return new UserResource($user);
    }

    public function me(Request $request)
    {
        return (new UserResource($request->user()))->showSensitiveFields();
    }

    public function update(UserRequest $request)
    {
        $user = $request->user();
<<<<<<< HEAD
        $attributes = $request->only(['name','email','introduction']);
        if($request->avatar_image_id){
            $image = Image::find($request->avatar_image_id);
=======

        $attributes = $request->only(['name', 'email', 'introduction', 'registration_id']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            $attributes['avatar'] = $image->path;
        }

        $user->update($attributes);

        return (new UserResource($user))->showSensitiveFields();
    }

    public function activedIndex(User $user)
    {
        UserResource::wrap('data');
        return UserResource::collection($user->getActiveUsers());
    }
}
