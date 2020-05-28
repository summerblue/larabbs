<?php

namespace Tests\Feature;

use App\Models\User;
use Facades\Tests\Setup\TopicFactory;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /**
     * @test
     */
    public function a_guest_can_view_topics()
    {
        $topic = TopicFactory::create();

        $this->followingRedirects()
            ->get('/topics')
            ->assertSee($topic->title);
    }

    /**
     * @test
     */
    public function a_guest_can_view_a_topic()
    {
        $topic = TopicFactory::create();

        $this->followingRedirects()
            ->get('/topics/' . $topic->id)
            ->assertSee($topic->title);
    }

    /**
     * @test
     */
    public function only_authors_can_view_the_edit_page_of_topic()
    {
        $topic = TopicFactory::create();
        $this->followingRedirects()
            ->actingAs($topic->user)
            ->get('/topics/' . $topic->id . '/edit')
            ->assertSee($topic->title);
    }

    /**
     * @test
     */
    public function only_authenticated_user_can_creat_a_topic()
    {
        $user = factory(User::class)->create();
        $data = [
            'title' => 'new title',
            'body' => 'new body',
            'category_id' => 1
        ];

        // guest
        $this->post('/topics/', $data)
            ->assertRedirect('/login');

        // author
        $this->followingRedirects()
            ->actingAs($user)
            ->post('/topics/', $data)
            ->assertSee($data['title']);
    }

    /**
     * @test
     */
    public function only_authors_can_update_topic()
    {
        $changes = [
            'title' => 'new title',
            'body' => 'new body',
            'category_id' => 1
        ];

        $topic = TopicFactory::create();

        // guest
        $this->patch('/topics/' . $topic->id, $changes)
            ->assertRedirect('/login');

        // member but not author
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->patch('/topics/' . $topic->id, $changes)
            ->assertStatus(403);

        // author
        $this->followingRedirects()
            ->actingAs($topic->user)
            ->patch('/topics/' . $topic->id, $changes)
            ->assertSee($changes['title']);
    }

    /**
     * @test
     */
    public function only_authors_can_delete_topic()
    {
        $topic = TopicFactory::create();

        // guest
        $this->delete('/topics/' . $topic->id)
            ->assertRedirect('/login');

        // member but not author
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->delete('/topics/' . $topic->id)
            ->assertStatus(403);

        // author
        $this->actingAs($topic->user)
            ->delete('/topics/' . $topic->id)
            ->assertRedirect('/topics');
        $this->assertDatabaseMissing('topics', ['title' => $topic->title]);
    }

    /**
     * @test
     */
    public function a_member_can_upload_an_image()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->post('/upload_image', [
                'upload_file' => $file = UploadedFile::fake()->image('random.jpg')
            ])->json();

        $filePath = 'public' . str_replace(env('APP_URL'), '', $response['file_path']);
        $this->assertFileExists($filePath);
        unlink($filePath);
    }
}
