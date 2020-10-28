<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocialAuthorizationRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'code' => 'required_without:access_token|string',
            'access_token' => 'required_without:code|string',
        ];
        if($this->type == 'wechat' && !$this->code){
            $rules['openid'] = 'required|string';
        }
        return $rules;
    }
}
