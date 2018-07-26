<?php

namespace App\Models\Traits;

use Hashids;

trait HashIdHelper
{
    private $hashId;

    // 调用 $model->hash_id 时触发
    public function getHashIdAttribute()
    {
        if (!$this->hashId) {
            $this->hashId = Hashids::encode($this->id);
        }

        return $this->hashId;
    }

    // 先将参数 decode 为模型id，再调用父类的 resolveRouteBinding 方法
    public function resolveRouteBinding($value)
    {
        if (!is_numeric($value)) {
            $value = current(Hashids::decode($value));
            if (!$value) {
                return;
            }
        }
        return parent::resolveRouteBinding($value);
    }

    // 使用 hash_id 生成 URL
    public function getRouteKey()
    {
        return $this->hash_id;
    }
}