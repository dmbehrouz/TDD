<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    use AuthenticatesUsers;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function Example()
    {
        $this->get('home')->assertStatus(200)
        ->assertViewIs('welcome');
    }

    public function test_user_view_login_page()
    {
        $this->get('login')->assertStatus(200)
            ->assertViewIs('auth.login');
    }

    public function test_user_view_register_page()
    {
        $this->get('register')->assertStatus(200)
            ->assertViewIs('auth.register');

    }
    public function test_user_cannot_login_when_authenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');

    }

    public function test_user_redirectTo_home_when_authenticate()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);
//        $this->assertDatabaseHas('users',['name' => 'behrouz','password'=>$password]  );
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_email()
    {
        $user = factory(User::class)->make();

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email
        ]);
        $response->assertRedirect('/login');
        $this->assertGuest();


    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->make();
        $response = $this->from('/login')->post('/login', [
            'password' =>$user->password
        ]);
        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_user_authenticated_logout_redirect_home_page()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->post('/logout');
        $response->assertRedirect('/');
    }
}
