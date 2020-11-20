<?php

namespace App\Http\Requests\Api;

class SocialAuthorizationRequest extends FormRequest
{
<<<<<<< HEAD
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
=======
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    public function rules()
    {
        $rules = [
            'code' => 'required_without:access_token|string',
            'access_token' => 'required_without:code|string',
        ];

<<<<<<< HEAD
        if($this->social_type == 'wechat' && !$this->code){
            $rules['openid'] = 'required|string';
        }
=======
        if ($this->social_type == 'wechat' && !$this->code) {
            $rules['openid']  = 'required|string';
        }

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        return $rules;
    }
}
