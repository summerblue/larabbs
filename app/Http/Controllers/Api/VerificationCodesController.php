<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends Controller
{
    //
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
//        return $this->response->array(['test_message'=>'store verification code']);
        $phone = $request->phone;
    if(!app()->environment('production'))
    {
        $code = '1234';
    }
    else
    {
        //生成4位随机数，左侧补0
        $code = str_pad(random_int(1,9999), 4,0, STR_PAD_LEFT);
        try{
            $result = $easySms->send($phone, [
                'content'=> "【手麦智能】您的验证码是{$code}。如非本人操作，请忽略本短信"
            ]);
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
            $message = $exception->getException('yunpian')->getMessage();
            return $this->response->errorInternal($message ?? '短信发送异常');
        }
    }

        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->adddMinutes(10);
        //缓存验证码  10分钟过期
        \cache::put($key, ['phone'=> $phone, 'code'=>$code], $expiredAt);
        return $this->response->array([
            'key'=> $key,
            'expired_at'=> $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);

    }
}
