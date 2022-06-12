<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'category_id' => (int)$this->category_id,
            'user_id' => (int)$this->user_id,
            'reply_count' => (int)$this->reply_count,
            'view_count' => (int)$this->view_count,
            'last_reply_user_id' => (int)$this->last_reply_user_id,
            'order' => (int)$this->order,
            'excerpt' => $this->excerpt,
            'slug' => $this->slug,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
