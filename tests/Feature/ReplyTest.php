<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\User;
use Facades\Tests\Setup\TopicFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function an_authenticated_user_can_leave_a_reply()
    {
        $topic = TopicFactory::create();
        $user = factory(User::class)->create();
        $this->followingRedirects()
            ->actingAs($user)
            ->post('/replies/', [
                'content' => 'my reply',
                'topic_id' => $topic->id
            ])
            ->assertSee('my reply');
    }

    /**
     * @test
     */
    public function a_guest_cannot_leave_a_reply()
    {
        $topic = TopicFactory::create();

        $this->post('/replies/', [
            'content' => 'my reply',
            'topic_id' => $topic->id
        ])
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function an_unauthorized_user_cannot_delete_reply()
    {
        $topic = TopicFactory::create();
        $replier = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();
        $reply = factory(Reply::class)->create([
            'topic_id' => $topic->id,
            'user_id' => $replier->id
        ]);

        //guest
        $this->delete('/replies/' . $reply->id)
            ->assertRedirect('/login');

        // unauthorized user
        $this->actingAs($anotherUser)->delete('/replies/' . $reply->id)
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function a_replier_can_delete_a_reply()
    {
        $topic = TopicFactory::create();
        $replier = factory(User::class)->create();
        $data = [
            'topic_id' => $topic->id,
            'user_id' => $replier->id
        ];
        $reply = factory(Reply::class)->create($data);

        $this->assertDatabaseHas('replies', $data);
        $this->actingAs($replier)->delete('/replies/' . $reply->id)->assertStatus(302);
        $this->assertDatabaseMissing('replies', $data);
    }

    /**
     * @test
     */
    public function unauthorized_user_cannot_delete_a_reply()
    {
        $topic = TopicFactory::create();
        $replier = factory(User::class)->create();
        $data = [
            'topic_id' => $topic->id,
            'user_id' => $replier->id
        ];
        $reply = factory(Reply::class)->create($data);

        $this->delete('/replies/' . $reply->id)->assertRedirect('/login');
        $user = factory(User::class)->create();
        $this->actingAs($user)->delete('/replies/' . $reply->id)->assertStatus(403);
    }

    /**
     * @test
     */
    public function a_topic_author_can_delete_any_reply()
    {
        $author = factory(User::class)->create();
        $topic = TopicFactory::ownedBy($author)->create();
        $amber = factory(User::class)->create();

        $replyOfAuthor = factory(Reply::class)->create([
            'topic_id' => $topic->id,
            'user_id' => $author->id
        ]);

        $replyOfAmber = factory(Reply::class)->create([
            'topic_id' => $topic->id,
            'user_id' => $amber->id
        ]);

        $this->actingAs($author)->delete('/replies/' . $replyOfAuthor->id)->assertStatus(302);
        $this->actingAs($author)->delete('/replies/' . $replyOfAmber->id)->assertStatus(302);
    }
}
