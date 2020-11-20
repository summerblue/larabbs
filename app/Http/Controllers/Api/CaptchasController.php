<?php

namespace App\Http\Controllers\Api;
<<<<<<< HEAD
use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaptchasController extends Controller
{
    public function store(CaptchaRequest $request,CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-' . Str::random(15);
        $phone = $request->phone;

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinute(2);

        \Cache::put($key,['phone'=>$phone,'code'=>$captcha->getPhrase()],$expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt,
            'captcha_image_content' => $captcha->inline(),
//            'code' =>$captcha->getPhrase(),
=======

use  Illuminate\Support\Str;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests\Api\CaptchaRequest;

class CaptchasController extends Controller
{
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-'.Str::random(15);
        $phone = $request->phone;

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(2);
        \Cache::put($key, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        ];

        return response()->json($result)->setStatusCode(201);
    }
}
