<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Models
use App\Models\Admin\AdminUsers;

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
        $admins = factory(AdminUsers::class, mt_rand(10, 20))->create();

        // Verify there are more than 10
        $this->assertTrue(count($admins) >= 10);
    }
}
