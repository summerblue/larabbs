<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
<<<<<<< HEAD
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
=======
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => (int) $this->user_id,
            'topic_id' => (int) $this->topic_id,
            'content' => $this->content,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'topic' => new TopicResource($this->whenLoaded('topic')),
        ];
    }
}
