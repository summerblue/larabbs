<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'category_id' => (int)$this->category_id,
            'user_id' => (int)$this->user_id,
<<<<<<< HEAD
            'reply_count' =>(int)$this->reply_count,
=======
            'reply_count' => (int)$this->reply_count,
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            'view_count' => (int)$this->view_count,
            'last_reply_user_id' => (int)$this->last_reply_user_id,
            'order' => (int)$this->order,
            'excerpt' => $this->excerpt,
            'slug' => $this->slug,
<<<<<<< HEAD
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
=======
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
