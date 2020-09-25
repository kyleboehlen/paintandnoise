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
        $this->assertTrue(Schema::hasTable('posters_statuses'));
        $this->assertTrue(Schema::hasTable('posters'));
        $this->assertTrue(Schema::hasTable('socials'));
        $this->assertTrue(Schema::hasTable('posters_socials'));
        $this->assertTrue(Schema::hasTable('posters_categories'));
        $this->assertTrue(Schema::hasTable('posts_types'));
        $this->assertTrue(Schema::hasTable('posts'));
        $this->assertTrue(Schema::hasTable('votes'));
        $this->assertTrue(Schema::hasTable('categories_posts_types'));
        $this->assertTrue(Schema::hasTable('cached_zip_searches'));
        $this->assertTrue(Schema::hasTable('cached_zip_codes'));
    }

    /**
     * Seed the database and verify categories seeded
     * 
     * @test
     */
    public function seedTest()
    {
        // Seed the database
        ob_start();
        Artisan::call('db:seed');
        ob_end_clean();

        // Check if there are 20 categories seeded
        $this->assertTrue(DB::table('categories')->get()->count() == 20);

        // Check for 5 admin tools
        $this->assertTrue(DB::table('admin_tools')->get()->count() == 5);

        // Check for 12 admin permissions
        $this->assertTrue(DB::table('admin_permissions')->get()->count() == 12);

        // Check for 6 poster statuses
        $this->assertTrue(DB::table('posters_statuses')->get()->count() == 6);

        // Check for 6 socials
        $this->assertTrue(DB::table('socials')->get()->count() == 6);

        // Verify super admin info
        $super_admin = AdminUsers::find(1);
        $super_admin_config = config('admin.super_admin');
        $this->assertTrue($super_admin->name == 'Super Admin');
        $this->assertTrue($super_admin->email == $super_admin_config['email']);
        $this->assertTrue($super_admin->password == Hash::check($super_admin_config['password'], $super_admin->password));
        $this->assertFalse(Hash::needsRehash($super_admin->password));

        // Verify super admin has all 12 admin permissions
        $this->assertTrue(DB::table('admin_users_permissions')->where('users_id', 1)->get()->count() == 12);

        // Check for 5 posts types
        $this->assertTrue(DB::table('posts_types')->get()->count() == 5);

        // Verify all categories posts types seeded
        $this->assertTrue(DB::table('categories_posts_types')->get()->count() == 15);
    }
}
