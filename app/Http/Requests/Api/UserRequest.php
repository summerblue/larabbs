<?php

namespace App\Http\Requests\Api;

<<<<<<< HEAD
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
=======
class UserRequest extends FormRequest
{

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
<<<<<<< HEAD
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

=======
        switch($this->method()) {
        case 'POST':
            return [
                'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
                'password' => 'required|string|min:6',
                'verification_key' => 'required|string',
                'verification_code' => 'required|string',
            ];
            break;
        case 'PATCH':
            $userId = auth('api')->id();

            return [
                'name' => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' .$userId,
                'email'=>'email|unique:users,email,'.$userId,
                'introduction' => 'max:80',
                'avatar_image_id' => 'exists:images,id,type,avatar,user_id,'.$userId,
            ];
            break;
        }
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }

    public function attributes()
    {
        return [
            'verification_key' => '短信验证码 key',
            'verification_code' => '短信验证码',
<<<<<<< HEAD
            'avatar_image_id' => '图片id'
=======
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        ];
    }

    public function messages()
    {
        return [
<<<<<<< HEAD
            'name.regex' => '用户名只支持英文、数字、横杆和下划线',
            'name.between' => '用户名必须介于 3 - 25 个字符之间',
=======
            'name.unique' => '用户名已被占用，请重新填写',
            'name.regex' => '用户名只支持英文、数字、横杆和下划线。',
            'name.between' => '用户名必须介于 3 - 25 个字符之间。',
            'name.required' => '用户名不能为空。',
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        ];
    }
}
