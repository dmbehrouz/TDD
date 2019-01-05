<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use DatabaseMigrations;
    use AuthenticatesUsers;


    /** @test*/

    public function a_user_can_view_profile_page()
    {
        $userLoggedIn = factory(User::class)->make();
        $response = $this->actingAs($userLoggedIn)->get('/home');
        $response->assertViewIs('home');

    }

    /** @test*/
    public function profile_page_has_user_photo()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->state('allField')->create();
        $response = $this->actingAs($user)->get('/home');;
        $response->assertSee($user->photo);
    }

    /** @test*/
    public function profile_page_has_user_name_and_family()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->state('allField')->create();
        $response = $this->actingAs($user)->get('/home');;
        $response->assertSee($user->name)->assertSee($user->family);
    }

    /** @test*/
    public function profile_page_has_user_email_and_phone()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->state('allField')->create();
        $response = $this->actingAs($user)->get('/home');
        $response->assertSee($user->email)->assertSee($user->phone);
    }
    
    /** @test*/
    public function profile_page_has_edit_button_for_update_profile()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->state('allField')->create();
        $this->actingAs($user)->get('/home')->assertSee('editButton');
    }
    
    /** @test*/
    public function user_loggedIn_can_edit_profile()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->state('allField')->make();
        $this->actingAs($user);
//        $userController = new UserController();
//        $this->assertInstanceOf(UserController::class,$userController);
        $response = $this->post(route('profile.update'),[
            'name'=>$user->name,
            'family'=>$user->family,
            'email'=>$user->email,
            'phone'=>$user->phone
        ]);
    }
}
