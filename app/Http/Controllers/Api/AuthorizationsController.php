<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Overtrue\Socialite\AccessToken;

class AuthorizationsController extends Controller
{
    public function socialStore(AuthorizationRequest $request, $social_type)
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
        return response()->json(['token' => $user->id]);
        
    }
}
