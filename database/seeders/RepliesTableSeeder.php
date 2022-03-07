<?php

namespace  Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RepliesTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        Reply::factory()->times(1000)->create();
    }
}
