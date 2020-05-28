<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function an_user_can_view_their_profile()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get('/users/' . $user->id)
            ->assertSee($user->name);
    }

    /**
     * @test
     */
    public function an_user_can_update_their_profile()
    {
        $user = factory(User::class)->create();
        $data = [
            'name' => 'Amy',
            'email' => 'ilovelaravel@gmail.com'
        ];

        $this->actingAs($user)->patch('/users/' . $user->id, $data);
        $this->assertDatabaseHas('users', $data);
    }


    /**
     * @test
     */
    public function a_guest_cannot_update_page_of_other_people()
    {
        $user = factory(User::class)->create();

        // Guests cannot access the edit page of other people
        $this->get('/users/' . $user->id . '/edit')
            ->assertRedirect('/login');

        // Guests cannot update the user profile of other people
        $data = [
            'name' => 'Amy',
            'email' => 'ilovelaravel@gmail.com'
        ];
        $this->patch('/users/' . $user->id, $data)
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function an_unauthorized_user_cannot_update_the_user_profile()
    {
        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();
        // Unauthorized user cannot access the edit page of other people
        $this->actingAs($anotherUser)->get('/users/' . $user->id . '/edit')
            ->assertStatus(403);

        // Unauthorized user cannot update the user profile of other people
        $data = [
            'name' => 'Amy',
            'email' => 'ilovelaravel@gmail.com'
        ];
        $this->patch('/users/' . $user->id, $data)
            ->assertStatus(403);
    }
}
