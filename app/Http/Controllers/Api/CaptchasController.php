<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class CaptchasController extends Controller
{
    public function store(CaptchaRequest $request)
    {
        $key = 'captcha-'.str_random(15);
        $phone = $request->phone;

        $expiredAt = now()->addMinutes(2);
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ];

        return $this->response->array($result)->setStatusCode(201);
    }
}
