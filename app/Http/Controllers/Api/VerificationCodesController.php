<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\VerificationCodeRequest;
use Overtrue\EasySms\EasySms;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\AuthenticationException;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {

        $captchaCacheKey =  'captcha_'.$request->captcha_key;
        $captchaData = Cache::get($captchaCacheKey);

        if(!$captchaData){
            abort(403, '图片验证码已失效');
        }

        if(!hash_equals($captchaData['code'], $request->captcha_code)){
            // 验证错误就清除缓存
            Cache::forget($captchaCacheKey);
            throw new AuthenticationException('验证码错误');
        }

        $phone = $captchaData['phone'];

        if(!app()->environment('production')){
            $code = '1234';
        }else{
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1,9999), 4, 0, STR_PAD_LEFT );

            try {
                $easySms->send($phone,[
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data' => [
                        'code' => $code
                    ]
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $e) {
                $message = $e->getException('aliyun')->getMessage();
                abort(500, $message ?: '短信发送异常');
            }
        }


        $key = Str::random(15);
        $cacheKey = 'verificationCodes_'.$key;
        $expiredAt = now()->addMinutes(5);
        Cache::put($cacheKey, ['phone' => $phone, 'code' => $code], $expiredAt);

        // 清除图片验证码缓存
        Cache::forget($captchaCacheKey);

        return response()->json(['key' => $key, 'expired_at' => $expiredAt->toDateTimeString()])->setStatusCode(201);
    }
}
