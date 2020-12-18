<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reply;

class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        Reply::factory()->times(1000)->create();
    }

}

