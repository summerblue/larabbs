<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Overtrue\Socialite\AccessToken;

class AuthorizationsController extends Controller
{
    public function socialStore(SocialAuthorizationRequest $request, $social_type)
    {
        $driver = \Socialite::driver($social_type);
        try{
            if ($code = $request->code){
                $accessToken = $driver->getAccessToken($code);
            }else{
                $tokenData['access_token'] = $request->access_token;
                if ($social_type == 'wechat') {
                    $tokenData['openid'] = $request->openid;
                }
                $accessToken = new AccessToken($tokenData);
            }
            $oauthUser = $driver->user($accessToken);
        } catch(\Exception $e){
            throw new AuthenticationException('参数错误，为获取用户信息');
        }
        
        switch ($social_type){
            case 'wechat':
                $unionid = $oauthUser->getOriginal()['unionid'] ?? null;
                if ($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                }else{
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();
                }
                if (!$user){
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $unionid
                    ]);
                }
                break;
        }
        $token = auth('api')->login($user);
        return $this->respondWithToken($token)->setStatusCode(201);
        
    }
    
    public function store(AuthorizationRequest $request)
    {
        $username = $request->name;
        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;
        $credentials['password'] = $request->password;
        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            throw new AuthenticationException('用户名或者密码错误');
        }
        return $this->respondWithToken($token)->setStatusCode(201);
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
           'access_token' => $token,
           'token_type' => 'Bearer',
           'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    
    public function update()
    {
        $token = auth('api')->refresh();
        return $this->respondWithToken($token);
    }
    
    public function destroy()
    {
        auth('api')->logout();
        return response(null, 204);
    }
}
