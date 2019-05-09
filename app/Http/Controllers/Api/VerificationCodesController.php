<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Api\VerificationCodeRequest;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $captchaData = \Cache::get($request->captcha_key);

        if (!$captchaData) {
            return $this->response->error('图片验证码已失效', 422);
        }

        if (!hash_equals($captchaData['code'], $request->captcha_code)) {
			// 验证错误就清除缓存
            \Cache::forget($request->captcha_key);
			return $this->response->errorUnauthorized('验证码错误');
        }

		$phone = $captchaData['phone'];

		if (!app()->environment('production')) {
			$code = '1234';
		} else {
			// 生成4位随机数，左侧补0
			$code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

			try {
				$result = $easySms->send($phone, [
					'content'  =>  "【Lbbs社区】您的验证码是{$code}。如非本人操作，请忽略本短信"
				]);
			} catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
				$message = $exception->getException('yunpian')->getMessage();
				return $this->response->errorInternal($message ?? '短信发送异常');
			}
		}

        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10);
        // 缓存验证码 10分钟过期。
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
		// 清除图片验证码缓存
		\Cache::forget($request->captcha_key);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
