<?php

namespace App\Http\Requests\Api;

class AuthorizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }
}
