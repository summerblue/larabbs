<?php

namespace App\Http\Requests\Api;

class TopicRequest extends FormRequest
{
<<<<<<< HEAD
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
=======
    public function rules()
    {
        switch($this->method()) {
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            case 'POST':
                return [
                    'title' => 'required|string',
                    'body' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                ];
<<<<<<< HEAD
=======
                break;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            case 'PATCH':
                return [
                    'title' => 'string',
                    'body' => 'string',
                    'category_id' => 'exists:categories,id',
                ];
<<<<<<< HEAD
        }

=======
                break;
        }
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }

    public function attributes()
    {
        return [
            'title' => '标题',
            'body' => '话题内容',
<<<<<<< HEAD
            'category_id' => '分类'
=======
            'category_id' => '分类',
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        ];
    }
}
