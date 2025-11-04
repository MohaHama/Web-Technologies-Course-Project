<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class AuthActionTest extends TestCase
{
    
    use RefreshDatabase;

    protected function setUp(): void{
        parent::setUp();
        $this->seed();
    }

    public function testRegistrationAction(): void
    {
        $user = User::first();

        // registration form
        $response = $this->get(route('registration.create'));
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get(route('registration.create'));
        $response->assertRedirect("/");
        ////

        // registration action
        $response = $this->post(route('registration.store', 
                                [
                                'name' => "random name",
                                'email' => "somemail@mail.com",
                                'password' => 'password'
                                ]));
        $this->assertAuthenticated();
        $response->assertRedirect("/");
        $response = $this->actingAs($user)
                        ->post(route('registration.store', 
                                [
                                'name' => "random name",
                                'email' => "somemail@mail.com",
                                'password' => 'password'
                                ]));
        $response->assertRedirect("/");
        ////
    }

    public function testLoginAction(): void
    {
        $user = User::first();

        // login from
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get(route('login'));
        $response->assertRedirect("/");
        ////

        // login action
        $response = $this->post(route('login.store', 
                                ['email' => $user->email,
                                'password' => 'password'
                                ]));
        $this->assertAuthenticated();
        $response->assertRedirect("/");
        $response = $this->actingAs($user)
                        ->post(route('login.store', 
                                ['email' => $user->email,
                                'password' => 'password'
                                ]));
        $response->assertRedirect("/");
        ////
    }

    public function testLogoutActionWithException(): void
    {

        // logout action
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $response = $this->post(route('login.destroy'));
        ////
    }

    public function testLogoutAction(): void
    {
        $user = User::first();

        // logout action
        $response = $this->post(route('login.destroy'));
        $response->assertRedirect(route('login'));
        $response = $this->actingAs($user)->post(route('login.destroy'));
        $this->assertGuest();
        $response->assertRedirect("/");
        ////
    }
}
