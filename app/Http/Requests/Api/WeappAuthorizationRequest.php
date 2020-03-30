<?php

namespace App\Http\Requests\Api;

class WeappAuthorizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|string',
        ];
    }
}
