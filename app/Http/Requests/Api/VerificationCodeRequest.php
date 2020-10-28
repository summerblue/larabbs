<?php

namespace App\Http\Requests\Api;

class VerificationCodeRequest extends FormRequest
{

    public function rules()
    {
        return [
            'captcha_key'=>'required|string',
            'captcha_code'=>'required|string'
        ];
    }

    public function attributes()
    {
        return [
            'captcha_key'=>'key必须',
            'captcha_code'=>'验证码'
        ];
    }
}
