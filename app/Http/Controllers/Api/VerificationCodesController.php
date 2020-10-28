<?php

namespace App\Http\Controllers\Api;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Auth\AuthenticationException;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request,EasySms $easySms){
        $key = $request->captcha_key;
        $captchaData = Cache::get($key);
        if(!$captchaData){
            abort(403,'图片验证码已失效');
        }
        if(!hash_equals($captchaData['code'],$request->captcha_code)){
            // 返回401
            throw new AuthenticationException('图片验证码错误');
        }

        $phone = $captchaData['phone'];
        if(!app()->environment('production')){
            $code = '1234';
        }else{
            $code = str_pad(random_int(1,9999),4,0);
            try {
                $easySms->send($phone, [
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data' => [
                        'code' => $code
                    ],
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                abort(500, $message ?: '短信发送异常');
            }
        }


        $key = 'verificationCode_'.Str::random(15);
        $expiredAt = now()->addMinutes(5);
        Cache::put($key,['phone'=>$phone,'code'=>$code],$expiredAt);

        return \response()->json([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
