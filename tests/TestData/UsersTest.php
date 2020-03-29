<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Models
use App\Models\Users;
use App\Models\Categories\Categories;
use App\Models\Categories\UsersCategories;

class UsersTest extends TestCase
{
    /**
     * Seed random users
     * 
     * @test
     */
    public function usersTest()
    {
        // Create random users using users factory
        $users = factory(Users::class, mt_rand(1000, 2000))->create();
        // Verify there are more than 100
        $this->assertTrue(count($users) >= 1000);
    }

    /**
     * Seed categories for that user to follow
     * 
     * @test
     */
    public function usersCategoriesTest()
    {
        // Create an average of 3 relationships per user
        $num_relationships = Users::all()->count() * 3;
        $i = 0;

        while($i < $num_relationships)
        {
            try
            {
                factory(UsersCategories::class)->create();
                $i++;
            }
            catch(\Exception $e)
            { /* skipping duplicate relationship */ }
        }
        
        // Verify there are the proper amount
        $this->assertTrue(UsersCategories::all()->count() == $num_relationships);
    }
}
