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
        $posters = Posters::factory(mt_rand(250, 500))->create(); // Do not go over 1000 posters in case there are not enough users_ids

        // Verify there are more than 500
        $this->assertTrue(count($posters) >= 250);
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

        foreach($posters as $poster)
        {
            for($i = 0; $i < mt_rand(1, 3); $i++)
            {
                $category = Categories::whereNotIn('id', 
                    Categories::whereNotNull('parent_id')->groupBy('parent_id')->pluck('parent_id')->toArray()
                )->get()->random();
                $ids = array(
                    'posters_id' => $poster->id,
                    'categories_id' => $category->id,
                );
                $poster_category = new PostersCategories($ids);
                try
                {
                    $poster_category->save();
                }
                catch(\Exception $e)
                { /* skipping duplicate relationship */ }
            }
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

        foreach($posters as $poster)
        {
            $socials = Socials::all()->random(mt_rand(1, 6));
            foreach($socials as $social)
            {
                $attr = array(
                    'posters_id' => $poster->id,
                    'socials_id' => $social->id,
                    'value' => json_encode($handles[$social->id]),
                    'verified' => 1, // Verified = true
                );

                $poster_social = new PostersSocials($attr);
                $poster_social->save();
            }
        }

        $this->assertTrue(PostersSocials::all()->count() >= count($posters));
    }
}
