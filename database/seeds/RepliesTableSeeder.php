<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        $replies = factory(Reply::class)->times(1000)->create();
    }
}
