<?php

namespace Tests\Feature;

use App\Models\Access;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /** @test */
    public function admin_view_login_page()
    {
        $this->get('adminlogin')->assertStatus(200)->assertViewIs('admin.login');
    }

    /** @test */
    public function an_admin_user_is_an_admin()
    {
        $admin = factory(User::class)->state('admin')->create();
        $access = factory(Access::class)->create();

        $response = $this->post(route('admin.post.login'),
            ['email'=>$admin->email,'password'=>'123456']);
        $this->assertEquals($admin->access_id,$access->state);


        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($admin);

    }
}
