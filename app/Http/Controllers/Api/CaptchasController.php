<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CaptchasController extends Controller
{
    public function store(CaptchaRequest $request,CaptchaBuilder $captchaBuilder){
        $key = 'captcha-'.Str::random(15);
        $phone =$request->phone;

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(5);
        Cache::put($key,['phone' => $phone, 'code' => $captcha->getPhrase()],$expiredAt);

        $result = [
            'captcha_key'=>$key,
            'expired_at'=>$expiredAt->toDateTimeString(),
            'url'=>url('api/v1/captchas/'.$key),
            'cptach_img_content'=>$captcha->inline(),
        ];
        return response()->json($result)->setStatusCode(201);
    }

    public function show(Request $request){
        $key = $request->captcha_key;
        $captchaData = Cache::get($key);
        if(!$captchaData){
            abort(403,'验证码已失效');
        }

        $captchaBuilder = new CaptchaBuilder($captchaData['code']);
        $captchaBuilder->build();
        header('Content-type: image/jpeg');

        $captchaBuilder->output();
    }
}
