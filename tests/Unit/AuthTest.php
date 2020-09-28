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
use App\Models\Admin\AdminPermissions;

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
        // Call root and assert redirect to about
        $response = $this->get('/');
        $response->assertRedirect('/about');

        // Assert ok to top
        $response = $this->get('/top');
        $response->assertStatus(200);

        // Assert redirects for top/{slug}, trending, and local
        $response = $this->get('/top/music');
        $response->assertRedirect('/login');
        $response = $this->get('/trending');
        $response->assertRedirect('/login');
        if(config('local.enabled'))
        {
            $response = $this->get('/local');
            $response->assertRedirect('/login');
        }

        // Create user
        $user = Users::factory()->make();

        // Unverify user email
        $user->email_verified_at = null;
        $this->assertTrue($user->save());

        // Call root and assert redirect to home
        $response = $this->actingAs($user)->get('/');
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

        // Assert ok for top/{slug}, trending, and local
        $response = $this->actingAs($user)->get('/top/music');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/trending');
        $response->assertStatus(200);
        if(config('local.enabled'))
        {
            $response = $this->actingAs($user)->get('/local');
            $response->assertStatus(200);
        }

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
        $admin = AdminUsers::factory()->create();

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

    /**
     * Test the admin permisssions functions are working properly
     *
     * @return void
     */
    public function testAdminPermissions()
    {
        // Create admin user
        $admin = AdminUsers::factory()->create();

        // Get a random permission
        $permission = AdminPermissions::all()->random();

        // Admin shouldn't have permission yet
        $this->assertFalse($admin->checkPermissions($permission->id));

        // Assign admin permission
        $this->assertTrue($admin->assignPermissions($permission->id));

        // Admin should have permission now
        $this->assertTrue($admin->checkPermissions($permission->id));

        // Create array with another random permission
        $permission_ids = array(
            $permission->id,
            AdminPermissions::where('id', '!=', $permission->id)->get()->random()->id,
        );

        // Admin shouldn't have next random permission yet
        $this->assertFalse($admin->checkPermissions($permission_ids[1]));

        // Assign Permissions to admin by array
        $this->assertTrue($admin->assignPermissions($permission_ids));

        // Verify admin has permissions
        $this->assertTrue($admin->checkPermissions($permission_ids));

        // Revoke first permission from admin
        $this->assertTrue($admin->revokePermissions($permission->id));

        // Verify still passes with array
        $this->assertTrue($admin->checkPermissions($permission_ids));

        // Revoke all permissions by array
        $this->assertTrue($admin->revokePermissions($permission_ids));

        // Verify permissions removed
        $this->assertFalse($admin->checkPermissions($permission_ids));
    }
}
