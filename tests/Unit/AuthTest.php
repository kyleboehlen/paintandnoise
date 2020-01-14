<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use Artisan;

// Models
use App\Models\Users;
use App\Models\Admin\AdminUsers;

class AuthTest extends TestCase
{
    /**
     * Test the user auth gaurd is working properly
     *
     * @return void
     * @test
     */
    public function testUserGaurd()
    {
        // Call root
        $response = $this->get('/');

        // Assert redirect to about
        $response->assertRedirect('/about');

        // Create user
        $user = $user = factory(Users::class)->create();

        // Unverify user email
        $user->email_verified_at = null;
        $this->assertTrue($user->save());

        // Call root
        $response = $this->actingAs($user)->get('/');

        // Assert redirect
        $response->assertRedirect('/home');

        // Test email verification redirect
        $response = $this->actingAs($user)->get('/home');
        $response->assertRedirect('/email/verify');

        // Verify user email
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $this->assertTrue($user->save());

        // Test logged in redirect
        $response = $this->actingAs($user)->get('/');
        $response->assertRedirect('/home');

        // Verify user session destroyed on user delete
        $this->assertTrue($user->delete());
        $this->assertTrue(!is_null($user->deleted_at));
        $this->flushSession();

        // Call root
        $response = $this->actingAs($user)->get('/');

        // Assert redirect
        $response->assertRedirect('/about');
    }

    /**
     * Test the admin auth gaurd is working properly
     *
     * @return void
     * @test
     */
    public function testAdminGaurd()
    {
        // Call admin
        $response = $this->get('/admin');

        // Assert redirect to login
        $response->assertRedirect('/admin/login');

        // Create admin user
        $admin = factory(AdminUsers::class)->create();

        // Call admin
        $response = $this->actingAs($admin, 'admin')->get('/admin');

        // Assert redirect to home
        $response->assertRedirect('/admin/home');

        // Verify session destroyed when admin created
        $this->assertTrue($admin->delete());
        $this->assertTrue(!is_null($admin->deleted_at));
        $this->flushSession();

        // Call admin
        $response = $this->actingAs($admin, 'admin')->get('/admin');

        // Assert redirect to login
        $response->assertRedirect('/admin/login');
    }
}
