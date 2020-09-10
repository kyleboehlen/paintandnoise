<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Models
use App\Models\Admin\AdminUsers;
use App\Models\Admin\AdminPermissions;
use App\Models\Admin\AdminUsersPermissions;

class AdminsTest extends TestCase
{
    /**
     * Seed admin users
     *
     * @return void
     * @test
     */
    public function adminsTest()
    {
        // Create random admin users using admin factory
        $admins = AdminUsers::factory(mt_rand(10, 20))->create();

        // Verify there are more than 10
        $this->assertTrue(count($admins) >= 10);
    }

    /**
     * Seed admin users permissions
     *
     * @return void
     * @test
     */
    public function adminsPermissionsTest()
    {
        // Create an average of 2 relationships per admin user
        $num_relationships = AdminUsers::all()->count() * 2;
        $i = 0;

        while($i < $num_relationships)
        {
            try
            {
                AdminUsersPermissions::factory()->create();
                $i++;
            }
            catch(\Exception $e)
            { /* skipping duplicate relationship */ }
        }
        
        // Verify there are the proper amount
        $this->assertTrue(AdminUsersPermissions::all()->count() == ($num_relationships + AdminPermissions::all()->count()));
    }
}
