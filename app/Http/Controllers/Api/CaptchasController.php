<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;

class CaptchasController extends Controller
{
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-' . Str::random(15);
        $phone = $request->phone;
        // 创建验证码
        $captcha = $captchaBuilder->build();
        $expireAt = now()->addMinute(2);
        // 存在缓存中
        Cache::put($key, [
            'phone' => $phone,
            'code' => $captcha->getPhrase(),
        ], $expireAt);
        
        $result = [
            'captcha_key' => $key,
            'expired_at' => $expireAt,
            'captcha_image_content' => $captcha->inline()
        ];
        
        return response()->json($result)->setStatusCode(201);
    }
}
