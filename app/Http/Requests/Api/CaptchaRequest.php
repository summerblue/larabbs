<?php

namespace App\Http\Requests\Api;

class CaptchaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required|unique:users|phone:CN,mobile'
        ];
    }
}
