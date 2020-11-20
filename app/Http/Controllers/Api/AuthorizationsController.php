<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD

use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Overtrue\Socialite\AccessToken;
use Overtrue\LaravelSocialite\Socialite;

class AuthorizationsController extends Controller
{
    public function socialStore($type,SocialAuthorizationRequest $request)
    {
        $driver = Socialite::driver($type);

        try{
            if($code = $request->code){
                $accessToken = $driver->getAccessToken($code);
            }else{
                $tokenData['access_token'] = $request->access_token;

                //微信需要增加openid
                if($type == 'wechat'){
                    $tokenData['openid'] = $request->openid;
                }

                $accessToken = new AccessToken($tokenData);
            }

            $oauthUser = $driver->user($accessToken);
        }catch(\Exception $e){
            throw new AuthenticationException('参数错误,为获取用户信息');
        }

        switch($type){
            case 'wechat' :
                $unionid = $oauthUser->getOriginal()['unionid']??null;
                if($unionid){
                    $user = User::where('weixin_unionid',$unionid)->first();
                }else{
                    $user = User::where('weixin_openid',$oauthUser->getId())->first();
                }

                //如果没有用户，默认创建一个用户
                if(!$user){
=======
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Overtrue\Socialite\AccessToken;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        $credentials['password'] = $request->password;

        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            throw new AuthenticationException(trans('auth.failed'));
        }

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    public function socialStore($type, SocialAuthorizationRequest $request)
    {
        $driver = \Socialite::driver($type);

        try {
            if ($code = $request->code) {
                $accessToken = $driver->getAccessToken($code);
            } else {
                $tokenData['access_token'] = $request->access_token;

                // 微信需要增加 openid
                if ($type == 'wechat') {
                    $tokenData['openid'] = $request->openid;
                }
                $accessToken = new AccessToken($accessData);
            }

            $oauthUser = $driver->user($accessToken);
        } catch (\Exception $e) {
           throw new AuthenticationException('参数错误，未获取用户信息');
        }

        switch ($type) {
            case 'wechat':
                $unionid = $oauthUser->getOriginal()['unionid'] ?? null;

                if ($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();
                }

                // 没有用户，默认创建一个用户
                if (!$user) {
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $unionid,
                    ]);
                }

                break;
        }

        $token = auth('api')->login($user);

        return $this->respondWithToken($token)->setStatusCode(201);
    }

<<<<<<< HEAD
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;

        filter_var($username,FILTER_VALIDATE_EMAIL)?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        $credentials['password'] = $request->password;

        if(!$token = \Auth::guard('api')->attempt($credentials)){
            throw new AuthenticationException(trans('auth.failed'));
        }

        return $this->respondWithToken($token)->setStatusCode(201);
    }

=======
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    public function update()
    {
        $token = auth('api')->refresh();
        return $this->respondWithToken($token);
    }

<<<<<<< HEAD

    public function destroy()
    {
        auth('api')->logout();
        return response(null,204);
    }


=======
    public function destroy()
    {
        auth('api')->logout();
        return response(null, 204);
    }

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
<<<<<<< HEAD
            'expires_in' => auth('api')->factory()->getTTL()*60
=======
            'expires_in' => auth('api')->factory()->getTTL() * 60
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        ]);
    }
}
