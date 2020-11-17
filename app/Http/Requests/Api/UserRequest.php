<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case 'POST':
                return [
                    'name' => 'required|between:3,10|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
                    'password' => 'required|alpha_dash|min:6',
                    'verification_key' => 'required|string',
                    'verification_code' => 'required|string',
                ];
                break;

            case "PATCH":
                $userId = auth('api')->id();
                return [
                    'name' => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'.$userId,
                    'email' => 'email|unique:users,email,'.$userId,
                    'introduction' => 'max:80',
                    'avatar_image_id' => Rule::exists('images','id')->where('user_id',$userId),
                ];
                break;
        }

    }

    public function attributes()
    {
        return [
            'verification_key' => '短信验证码 key',
            'verification_code' => '短信验证码',
            'avatar_image_id' => '图片id'
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => '用户名只支持英文、数字、横杆和下划线',
            'name.between' => '用户名必须介于 3 - 25 个字符之间',
        ];
    }
}
