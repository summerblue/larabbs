<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\AuthenticationException;

class UsersController extends Controller
{
    public function store(UserRequest $request){
        $verificationData = Cache::get($request->verification_key);
        if(!$verificationData){
            abort(403,'验证码已失效');
        }
        if(!hash_equals($verificationData['code'],$request->verification_code)){
            // 返回401
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verificationData['phone'],
            'password' => $request->password,
        ]);
        Cache::forget($request->verification_key);
        return new UserResource($user);
    }

    /*
     * 某个用户的信息
     */
    public function show(User $user){
        return new UserResource($user);
    }
    /*
     * 当前登录用户的信息
     */
    public function me(Request $request){
        return (new UserResource($request->user()))->showSensitiveFields();
    }

    /*
     * 编辑当前用户信息
     */
    public function update(UserRequest $request){
        $user = $request->user();
        $attributes = $request->only(['name','email','introduction']);
        if($request->avatar_image_id){
            $image = Image::find($request->avatar_image_id);
            $attributes['avatar'] = $image->path;
        }
        $user->update($attributes);
        return (new UserResource($request->user()))->showSensitiveFields();
    }

    /*
     * 活跃用户列表
     */
    public function activedIndex(User $user){
        $users = $user->getActiveUsers();
        UserResource::wrap('data');
        return UserResource::collection($users);
    }

    public function test22(User $user){
        echo '55555';
        return $user->name;
    }
}
