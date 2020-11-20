<?php

namespace Tests\Feature;

<<<<<<< HEAD
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\ActingJWTUser;
use Tests\TestCase;
=======
use Tests\TestCase;
use App\Models\User;
use App\Models\Topic;
use Tests\Traits\ActingJWTUser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

class TopicApiTest extends TestCase
{
    use RefreshDatabase;
    use ActingJWTUser;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

<<<<<<< HEAD

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreTopic()
    {
        $data = [
            'category_id' => 1,
            'body' => 'test body',
            'title' => 'test title',
        ];

        $response = $this->JWTActingAs($this->user)
            ->json('POST','api/v1/topics',$data);
=======
    public function testStoreTopic()
    {
        $data = ['category_id' => 1, 'body' => 'test body', 'title' => 'test title'];

        $response = $this->JWTActingAs($this->user)
                         ->json('POST', '/api/v1/topics', $data);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

        $assertData = [
            'category_id' => 1,
            'user_id' => $this->user->id,
            'title' => 'test title',
<<<<<<< HEAD
            'body' => clean('test body','user_topic_body'),
        ];

        $response->assertStatus(201)->assertJsonFragment($assertData);
=======
            'body' => clean('test body', 'user_topic_body'),
        ];

        $response->assertStatus(201)
                 ->assertJsonFragment($assertData);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }

    public function testUpdateTopic()
    {
        $topic = $this->makeTopic();

<<<<<<< HEAD
        $editData = [
            'category_id'=>2,'body'=>'edit body','title'=>'edit title',
        ];

        $response = $this->JWTActingAs($this->user)
            ->json('PATCH','/api/v1/topics/'.$topic->id,$editData);

        $assertData = [
            'category_id' => 2,
            'user_id' => $this->user->id,
            'title' => 'edit title',
            'body' => clean('edit body','user_topic_body')
        ];

        $response->assertStatus(200)->assertJsonFragment($assertData);
=======
        $editData = ['category_id' => 2, 'body' => 'edit body', 'title' => 'edit title'];

        $response = $this->JWTActingAs($this->user)
                         ->json('PATCH', '/api/v1/topics/'.$topic->id, $editData);

        $assertData= [
            'category_id' => 2,
            'user_id' => $this->user->id,
            'title' => 'edit title',
            'body' => clean('edit body', 'user_topic_body'),
        ];

        $response->assertStatus(200)
                 ->assertJsonFragment($assertData);
    }

    protected function makeTopic()
    {
        return factory(Topic::class)->create([
            'user_id' => $this->user->id,
            'category_id' => 1,
        ]);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }

    public function testShowTopic()
    {
        $topic = $this->makeTopic();
<<<<<<< HEAD

        $response = $this->json('GET','/api/v1/topics/'.$topic->id);

        $assertData = [
=======
        $response = $this->json('GET', '/api/v1/topics/'.$topic->id);

        $assertData= [
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            'category_id' => $topic->category_id,
            'user_id' => $topic->user_id,
            'title' => $topic->title,
            'body' => $topic->body,
        ];

<<<<<<< HEAD
        $response->assertStatus(200)->assertJsonFragment($assertData);

=======
        $response->assertStatus(200)
                 ->assertJsonFragment($assertData);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }

    public function testIndexTopic()
    {
<<<<<<< HEAD
        $response = $this->json('GET','api/v1/topics');

        $response->assertStatus(200)->assertJsonStructure(['data','meta']);
    }


    public function testDeleteTopic()
    {
        $topic = $this->makeTopic();

        $response = $this->JWTActingAs($this->user)
            ->json('DELETE','api/v1/topics/'.$topic->id);
        $response->assertStatus(204);

        $response = $this->json('GET','api/v1/topics/'.$topic->id);

        $response->assertStatus(404);
    }




    protected function makeTopic()
    {
        return factory(Topic::class)->create([
            'user_id'=>$this->user->id,
            'category_id'=>1
        ]);
    }
=======
        $response = $this->json('GET', '/api/v1/topics');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'meta']);
    }

    public function testDeleteTopic()
    {
        $topic = $this->makeTopic();
        $response = $this->JWTActingAs($this->user)
                         ->json('DELETE', '/api/v1/topics/'.$topic->id);
        $response->assertStatus(204);

        $response = $this->json('GET', '/api/v1/topics/'.$topic->id);
        $response->assertStatus(404);
    }
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
}
