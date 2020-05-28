<?php

namespace Tests\Feature;

use App\Models\Topic;
use Facades\Tests\Setup\TopicFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /**
     * @test
     */
    public function topics_are_in_descending_order()
    {
        TopicFactory::create();
        TopicFactory::create();
        TopicFactory::create();

        $latestTopic = Topic::where('category_id', 1)->orderBy('updated_at', 'desc')->first();
        $topics = $this->get('/categories/1')->getOriginalContent()->getData()['topics'];
        $this->assertCount(3, $topics);
        $this->assertEquals($latestTopic->title, $topics->first()->title);
    }
}
