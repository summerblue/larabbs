<?php

namespace App\Http\Requests\Api;

class CaptchaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|phone:CN,mobile|unique:users',
        ];
    }
}
