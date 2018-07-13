<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;


class VerificationCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
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
