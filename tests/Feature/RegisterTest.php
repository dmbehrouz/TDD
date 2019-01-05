<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    use AuthenticatesUsers;

    public function test_user_view_register_page()
    {
        $this->get('register')->assertStatus(200)
            ->assertViewIs('auth.register');
    }
    public function test_a_user_can_register()
    {
        $user = factory(User::class)->make();

        $this->withoutExceptionHandling();

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password = $user->password,
            'password_confirmation'=>$password
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
        $response->assertRedirect('/home');
        $this->withSession(['email' => $user->email]);
    }

    public function test_a_user_cannot_register_with_exist_email()
    {
        $createUser = factory(User::class)->create();
        $this->withExceptionHandling();

        $response = $this->from('/register')->post('/register', [
            'name' => $createUser->name,
            'email' => $createUser->email,
            'password' => $createUser->password,
            'password_confirmation'=>$createUser->password
        ]);
        $response->assertSessionHasErrors(['email']);
    }

}
