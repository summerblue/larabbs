<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
<<<<<<< HEAD
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'data' => $this->data,
            'read_at' => (string) $this->read_at??null,
            'created_at' => (string)$this->created_at,
=======
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'type' => $this->type,
            'data' => $this->data,
            'read_at' => (string) $this->read_at ?: null,
            'created_at' => (string) $this->created_at,
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        ];
    }
}
