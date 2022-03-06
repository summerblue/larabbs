<?php

namespace Database\Factories;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence(),
            'topic_id' => rand(1, 100),
            'user_id' => rand(1, 10),
        ];
    }
}
