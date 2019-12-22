<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// Models
use App\Models\Users;
use App\Models\Categories\Categories;
use App\Models\Categories\UsersCategories;

class AccountManagementTest extends TestCase
{
    /**
     * Test categories pages
     *
     * @return void
     * @test
     */
    public function categoriesTest()
    {
        // Create a user with no categories
        $user = factory(Users::class)->create();

        // Test user can reach categories page
        $response = $this->actingAs($user)->get('/account/categories');
        $response->assertStatus(200);

        // Get categories ids with sub categories
        $categories_ids = Categories::all()->filter(function($category){
            return $category->subCategoriesCount() > 0;
        })->values()->pluck('id')->toArray();

        foreach($categories_ids as $category_id)
        {
            // Test subcategory pages give redirects with no categories for user
            $response = $this->actingAs($user)->get("/account/categories/$category_id");
            $response->assertStatus(302);

            // Add categories for user that have subcategories
            $users_categories = new UsersCategories;
            $users_categories->users_id = $user->id;
            $users_categories->categories_id = $category_id;
            $this->assertTrue($users_categories->save());

            // Test subcategory pages can be reached after adding categories for user
            $response = $this->actingAs($user)->get("/account/categories/$category_id");
            $response->assertStatus(200);
        }
    }
}
