<?php

namespace App\Http\Requests\Api;

class ImageRequest extends FormRequest
{
<<<<<<< HEAD
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
=======
    public function rules()
    {

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        $rules = [
            'type' => 'required|string|in:avatar,topic',
        ];

<<<<<<< HEAD
        if($this->type == 'avatar'){
            $rules['image'] = 'required|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200';
        }else{
=======
        if ($this->type == 'avatar') {
            $rules['image'] = 'required|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200';
        } else {
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            $rules['image'] = 'required|mimes:jpeg,bmp,png,gif';
        }

        return $rules;
    }

<<<<<<< HEAD
    public function messages()
    {
        return [
            'image.dimensions' => '图片清晰度不够，宽和高需要200px以上'
        ];
    }
=======
      public function messages()
      {
          return [
              'image.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
          ];
      }
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
}
