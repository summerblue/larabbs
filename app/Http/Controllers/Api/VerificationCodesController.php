<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request,EasySms $easySms)
    {
        $captchaData = \Cache::get($request->captcha_key);

        if(!$captchaData){
            abort(403,'图片验证码已失效');
        }

        if(!hash_equals($captchaData['code'],$request->captcha_code)){
            //验证错误就清除缓存
=======
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Auth\AuthenticationException;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $captchaData = \Cache::get($request->captcha_key);

        if (!$captchaData) {
            abort(403, '图片验证码已失效');
        }

        if (!hash_equals($captchaData['code'], $request->captcha_code)) {
            // 验证错误就清除缓存
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            \Cache::forget($request->captcha_key);
            throw new AuthenticationException('验证码错误');
        }

        $phone = $captchaData['phone'];

<<<<<<< HEAD
        //如果不是production环境，则不用发送短信
        if(!app()->environment('production')){
            $code = '1234';
        }else{
            $code = str_pad(random_int(1,9999),4,0,STR_PAD_LEFT);
            try{
                $result = $easySms->send($phone,[
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data' => [
                        'code' => $code,
                    ],
                ]);
            }catch(\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
                $message = $exception->getException('aliyun')->getMessage();
                abort(500,$message??'短信发送异常');
            }
        }
        $key = 'verificationCode_'.Str::random(15);
        $expiredAt = now()->addMinute(5);

        //缓存验证码5分钟过期
        \Cache::put($key,['phone'=>$phone,'code'=>$code],$expiredAt);
=======
        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

            try {
                $result = $easySms->send($phone, [
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
        // 缓存验证码 5分钟过期。
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        // 清除图片验证码缓存
        \Cache::forget($request->captcha_key);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

        return response()->json([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
