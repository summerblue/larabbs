<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function users_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/');
    }

    /**
     * @test
     */
    public function users_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel')
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function users_can_logout()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post('/logout');
        $this->assertGuest();
    }
}
