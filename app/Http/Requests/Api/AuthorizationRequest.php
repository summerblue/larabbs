<?php

namespace App\Http\Requests\Api;

class AuthorizationRequest extends FormRequest
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
        return [
            'username' => 'required|string',
            'password' => 'required|alpha_dash|min:6',
        ];
    }
}
