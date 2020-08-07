<?php

namespace App\Http\Controllers\Api;

use App\Traits\PassportToken;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Overtrue\Socialite\AccessToken;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use Psr\Http\Message\ServerRequestInterface;
use League\OAuth2\Server\AuthorizationServer;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\Exception\OAuthServerException;

class AuthorizationsController extends Controller
{
    use PassportToken;

    public function store(AuthorizationRequest $originRequest, AuthorizationServer $server, ServerRequestInterface $serverRequest)
    {
        try {
            return $server->respondToAccessTokenRequest($serverRequest, new Psr7Response)->withStatus(201);
        } catch(OAuthServerException $e) {
            throw new AuthenticationException($e->getMessage());
        }
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
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $unionid,
                    ]);
                }

                break;
        }
        $result = $this->getBearerTokenByUser($user, '1', false);
        return response()->json($result)->setStatusCode(201);
    }

    public function update(AuthorizationServer $server, ServerRequestInterface $serverRequest)
	{
		try {
		   return $server->respondToAccessTokenRequest($serverRequest, new Psr7Response);
		} catch(OAuthServerException $e) {
            throw new AuthenticationException($e->getmessage());
        }
	}

    public function destroy()
    {
        if (auth('api')->check()) {
            auth('api')->user()->token()->revoke();
            return response(null, 204);
		} else {
            throw new AuthenticationException('The token is invalid.');
		}
	}
}
