<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use Illuminate\Support\Facades\Auth;
use Overtrue\Socialite\AccessToken;
use Illuminate\Auth\AuthenticationException;
use App\Models\User;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\JWT;


class AuthorizationsController extends Controller
{
    /*
     * 第三方登录
     */
    public function socialStore($type,SocialAuthorizationRequest $request){
        $driver = \Socialite::driver($type);
        try {
            if($code = $request->code){
                $accessToken = $driver->getAccessToken($code);
            }else{
                $tokenData['access_token'] = $request->access_token;

                // 微信需要增加 openid
                if ($type == 'wechat') {
                    $tokenData['openid'] = $request->openid;
                }
                $accessToken = new AccessToken($tokenData);
            }
            $oauthUser = $driver->user($accessToken);
        }catch (\Exception $e) {
            throw new AuthenticationException('参数错误，未获取用户信息');
        }

        switch ($type){
            case 'wechat':
                $unionid = $oauthUser->getOriginal()['unionid'] ?? null;
                if($unionid){
                    $user = User::where('weixin_unionid',$unionid)->first();
                }else{
                    $user = User::where('weixin_openid',$oauthUser->getId())->first();
                }
                //没有用户创建一个
                if(!$user){
                    $user = User::create([
                        'name'=>$oauthUser->getNickname(),
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

    //登录
    public function store(AuthorizationRequest $request){
        $username = $request->username;
        filter_var($username,FILTER_VALIDATE_EMAIL) ? $credentials['email'] = $username : $credentials['phone'] = $username;
        $credentials['password'] = $request->password;
        if(!$token = auth('api')->attempt($credentials)){
            throw new AuthenticationException('用户名或密码错误');
        }

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    //刷新token
    public function update(){
        $token = auth('api')->refresh();
        return $this->respondWithToken($token);
    }

    //删除token
    public function destroy(){
        auth('api')->logout();
        return response(null, 204);
    }

    //简单封装
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
