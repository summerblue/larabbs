<?php

namespace App\Http\Requests\Api;

class ReplyRequest extends FormRequest
{
<<<<<<< HEAD
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|min:2'
=======
    public function rules()
    {
        return [
            'content' => 'required|min:2',
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        ];
    }
}
