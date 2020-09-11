<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Models
use App\Models\Categories\Categories;
use App\Models\Posters\Posters;
use App\Models\Posters\PostersCategories;
use App\Models\Posters\PostersSocials;
use App\Models\Socials\Socials;
use App\Models\Users;

class PostersTest extends TestCase
{
    /**
     * Seed posters
     *
     * @return void
     * @test
     */
    public function postersTest()
    {
        // Create random posters using posters factory
        $posters =
            Posters::factory()->count(
                mt_rand(
                    intval(Users::all()->count() * config('test.min_percent_users_post')),
                    intval(Users::all()->count() * config('test.max_percent_users_post'))
                )
            )->create();

        // Verify there are X% of users as posters
        $this->assertTrue(Posters::all()->count() >= intval(Users::all()->count() * config('test.min_percent_users_post')));
    }

    /**
     * Seed posters categories
     *
     * @return void
     * @test
     */
    public function postersCategoriesTest()
    {
        // Create at least one relationship per poster
        $posters = Posters::all();
        $categories = collect();
        
        foreach(Categories::all() as $category)
        {
            if($category->subCategoriesCount() == 0)
            {
                $categories->add($category);
            }
        }

        $insert = array();
        foreach($posters as $poster)
        {
            foreach($categories->random(mt_rand(1, 3)) as $category)
            {
                array_push($insert, [
                    'posters_id' => $poster->id,
                    'categories_id' => $category->id,
                ]);
            }
        }
        
        foreach(array_chunk($insert, config('app.chunk_insert_size')) as $chunk_insert)
        {
            PostersCategories::insert($chunk_insert);
        }

        $this->assertTrue(PostersCategories::all()->count() >= count($posters));
    }

    /**
     * Seed posters socials
     *
     * @return void
     * @test
     */
    public function postersSocialsTest()
    {
        // Give posters a random number of social media links
        $posters = Posters::all();
        $handles = config('test.social_handles');
        $socials = Socials::all();

        $insert = array();
        foreach($posters as $poster)
        {
            foreach($socials->random(mt_rand(1, $socials->count())) as $social)
            {
                array_push($insert, [
                    'posters_id' => $poster->id,
                    'socials_id' => $social->id,
                    'value' => json_encode($handles[$social->id]),
                    'verified' => 1, // Verified = true
                ]);
            }
        }

        foreach(array_chunk($insert, config('app.chunk_insert_size')) as $chunk_insert)
        {
            PostersSocials::insert($chunk_insert);
        }

        $this->assertTrue(PostersSocials::all()->count() >= count($posters));
    }
}
