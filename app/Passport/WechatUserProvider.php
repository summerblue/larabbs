<?php

namespace App\Passport;

use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Sk\Passport\UserProvider;
 use Illuminate\Auth\AuthenticationException;

class WechatUserProvider extends UserProvider
{
    public function validate(ServerRequestInterface $request)
    {
        $this->validateRequest($request, [
            'code' => 'required_without:access_token|string',
            'access_token' => 'required_without:code|string',
            'openid'  => 'required_with:access_token|string',
        ]);
    }

    public function retrieve(ServerRequestInterface $request)
    {
        $inputs = $this->only($request, [
            'code',
            'access_token',
            'openid',
        ]);

        $driver = \Socialite::create('wechat');
        try {
            if ($code = $inputs['code']) {
                $oauthUser = $driver->userFromCode($code);
            } else {
                $tokenData['access_token'] = $inputs['access_token'];

                // 微信需要增加 openid
                if ($type == 'wechat') {
                    $driver->withOpenid($inputs['openid']);
                }

                $oauthUser = $driver->userFromToken($inputs['access_token']);
            }
        } catch (\Exception $e) {
            throw new AuthenticationException('参数错误，未获取用户信息');
        }

        if (!$oauthUser->getId()) {
            throw new AuthenticationException('参数错误，未获取用户信息');
        }

        $unionid = $oauthUser->getRaw()['unionid'] ?? null;

        if ($unionid) {
            $user = User::where('weixin_unionid', $unionid)->first();
        } else {
            $user = User::where('weixin_openid', $oauthUser->getId())->first();
        }

        // 没有用户，默认创建一个用户
        if (!$user) {
            $user = User::create([
                'name' => $oauthUser->getNickname(),
                'avatar' => $oauthUser->getAvatar(),
                'weixin_openid' => $oauthUser->getId(),
                'weixin_unionid' => $unionid,
            ]);
        }

        return $user;
    }
}
