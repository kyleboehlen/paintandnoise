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
        $users = Users::factory()->count(mt_rand(config('test.min_test_users'), config('test.max_test_users')))->create();

        // Verify there are more than the minimum test users
        $this->assertTrue(count($users) >= config('test.min_test_users'));
    }

    /**
     * Seed categories for that user to follow
     * 
     * @test
     */
    public function usersCategoriesTest()
    {
        $users = Users::all();
        $categories = collect();
        
        foreach(Categories::all() as $category)
        {
            if($category->subCategoriesCount() == 0)
            {
                $categories->add($category);
            }
        }

        $insert = array();
        foreach($users as $user)
        {
            foreach($categories->random(mt_rand(3, $categories->count())) as $category)
            {
                array_push($insert, [
                    'users_id' => $user->id,
                    'categories_id' => $category->id,
                ]);
            }
        }

        foreach(array_chunk($insert, config('app.chunk_insert_size')) as $chunk_insert)
        {
            UsersCategories::insert($chunk_insert);
        }
        
        // Verify there are the proper amount
        $this->assertTrue(UsersCategories::all()->count() >= ($users->count() * 3));
    }
}
