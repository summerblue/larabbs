<?php

namespace App\Http\Requests\Api;

class VerificationCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
<<<<<<< HEAD
//        return [
//            'phone' => [
//                'required',
//                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}/',
//                'unique:users'
//            ]
//        ];
=======
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        return [
            'captcha_key' => 'required|string',
            'captcha_code' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'captcha_key' => '图片验证码 key',
            'captcha_code' => '图片验证码',
        ];
    }
}
