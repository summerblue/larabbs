<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
<<<<<<< HEAD

    protected $showSensitiveFields = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(!$this->showSensitiveFields){
            $this->resource->makeHidden(['phone','email']);
=======
    protected $showSensitiveFields = false;

    public function toArray($request)
    {
        if (!$this->showSensitiveFields) {
            $this->resource->makeHidden(['phone', 'email']);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        }

        $data = parent::toArray($request);

<<<<<<< HEAD
        $data['bound_phone'] = $this->resource->phone?true:false;
        $data['bound_wechat'] = ($this->resource->weixin_unionid || $this->resource->weixin_openid) ? true:false;
        $data['roles'] = RoleResource::collection($this->whenLoaded('roles'));
=======
        $data['bound_phone'] = $this->resource->phone ? true : false;
        $data['bound_wechat'] = ($this->resource->weixin_unionid || $this->resource->weixin_openid) ? true : false;
        $data['roles'] = RoleResource::collection($this->whenloaded('roles'));
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

        return $data;
    }

    public function showSensitiveFields()
    {
        $this->showSensitiveFields = true;
<<<<<<< HEAD
=======

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        return $this;
    }
}
