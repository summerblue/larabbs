<?php

namespace Tests\Setup;

use App\Models\Topic;
use App\Models\User;

class TopicFactory
{
    protected $user;

    public function create()
    {
        $topic = factory(Topic::class)->create([
            'user_id' => $this->user ?? factory(User::class),
            'category_id' => 1
        ]);

        return $topic;
    }

    public function ownedBy(User $user)
    {
        $this->user = $user;
        return $this;
    }
}
