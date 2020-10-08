<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Carbon\Carbon;

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

    /**
     * Create a test user so I don't have to make one every time I run tests
     * 
     * @test
     */
    public function testUserTest()
    {
        $attr = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('testtesttest'),
        ];

        $test_user = new Users($attr); // Instantiate model
        $test_user->email_verified_at = Carbon::now()->toDatetimeString(); // Verify email (not fillable)
        $test_user->profile_picture = '/test/' . rand(0, 12) . '.jpg';

        $this->assertTrue($test_user->save());

    }
}
