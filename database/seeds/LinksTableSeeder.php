<?php

use Illuminate\Database\Seeder;
use App\Models\Link;

class LinksTableSeeder extends Seeder
{
    public function run()
    {
        // 生成数据集合
        $links = factory(Link::class)->times(6)->create();
    }
}
