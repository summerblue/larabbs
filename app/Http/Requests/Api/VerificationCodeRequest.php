<?php

namespace App\Http\Requests\Api;

class VerificationCodeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'captcha_key' => 'required|string',
            'captcha_code' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'captcha_key' => '图片验证码 key',
            'captcha_code' => '图片验证码 code',
        ];
    }
}
