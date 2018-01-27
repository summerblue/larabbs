<?php

namespace App\Transformers;

use App\Models\Reply;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'topic'];

    public function transform(Reply $reply)
    {
        return [
            'id' => $reply->id,
            'user_id' => (int) $reply->user_id,
            'topic_id' => (int) $reply->topic_id,
            'content' => $reply->content,
            'created_at' => $reply->created_at->toDateTimeString(),
            'updated_at' => $reply->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(Reply $reply)
    {
        return $this->item($reply->user, new UserTransformer());
    }

    public function includeTopic(Reply $reply)
    {
        return $this->item($reply->topic, new TopicTransformer());
    }
}
