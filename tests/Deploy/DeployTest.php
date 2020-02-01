<?php

namespace Tests\Deploy;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Artisan;
use Schema;
use Hash;
use DB;

// Models
use App\Models\Admin\AdminUsers;

class DeployTest extends TestCase
{
    /**
     * Migrate database and verify tables exsist
     *
     * @test
     */
    public function migrateTest()
    {
        // Migrate database
        Artisan::call('migrate');

        // Check if tables exsist
        $this->assertTrue(Schema::hasTable('categories'));
        $this->assertTrue(Schema::hasTable('failed_jobs'));
        $this->assertTrue(Schema::hasTable('migrations'));
        $this->assertTrue(Schema::hasTable('password_resets'));
        $this->assertTrue(Schema::hasTable('users'));
        $this->assertTrue(Schema::hasTable('users_categories'));
        $this->assertTrue(Schema::hasTable('sessions'));
        $this->assertTrue(Schema::hasTable('admin_users'));
        $this->assertTrue(Schema::hasTable('admin_tools'));
        $this->assertTrue(Schema::hasTable('admin_permissions'));
        $this->assertTrue(Schema::hasTable('admin_users_permissions'));
        $this->assertTrue(Schema::hasTable('admin_password_resets'));
    }

    /**
     * Seed the database and verify categories seeded
     * 
     * @test
     */
    public function seedTest()
    {
        // Seed the database
        Artisan::call('db:seed');

        // Check if there are 19 categories seeded
        $this->assertTrue(DB::table('categories')->get()->count() == 19);

        // Check for 4 admin tools
        $this->assertTrue(DB::table('admin_tools')->get()->count() == 4);

        // Check for 11 admin permissions
        $this->assertTrue(DB::table('admin_permissions')->get()->count() == 11);

        // Check for 6 poster statuses
        $this->assertTrue(DB::table('poster_statuses')->get()->count() == 6);

        // Verify super admin info
        $super_admin = AdminUsers::find(1);
        $this->assertTrue($super_admin->name == 'Super Admin');
        $this->assertTrue($super_admin->email == env('SUPER_ADMIN_EMAIL'));
        $this->assertTrue($super_admin->password == Hash::check(env('SUPER_ADMIN_PASSWORD'), $super_admin->password));
        $this->assertFalse(Hash::needsRehash($super_admin->password));

        // Verify super admin has all 11 admin permissions
        $this->assertTrue(DB::table('admin_users_permissions')->where('admin_users_id', 1)->get()->count() == 11);
    }
}
