<?php

use Illuminate\Database\Seeder;

// Constant Helpers
use App\Http\Helpers\Constants\Categories;
use App\Http\Helpers\Constants\Posts\Types;

class CategoriesPostsTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_posts_types = array(
            array(
                'categories_id' => Categories::MUSIC,
                'types_id' => Types::AUDIO,
            ),
            array(
                'categories_id' => Categories::MUSIC,
                'types_id' => Types::VIDEO,
            ),
            array(
                'categories_id' => Categories::MUSIC,
                'types_id' => Types::EMBEDDED_SOUNDCLOUD,
            ),
            array(
                'categories_id' => Categories::VISUAL_ART_2D,
                'types_id' => Types::IMAGE,
            ),
            array(
                'categories_id' => Categories::VISUAL_ART_2D,
                'types_id' => Types::VIDEO,
            ),
            array(
                'categories_id' => Categories::VISUAL_ART_3D,
                'types_id' => Types::IMAGE,
            ),
            array(
                'categories_id' => Categories::VISUAL_ART_3D,
                'types_id' => Types::VIDEO,
            ),
            array(
                'categories_id' => Categories::DIGITAL_ART,
                'types_id' => Types::IMAGE,
            ),
            array(
                'categories_id' => Categories::DIGITAL_ART,
                'types_id' => Types::VIDEO,
            ),
            array(
                'categories_id' => Categories::PERFORMANCE_ART,
                'types_id' => Types::IMAGE,
            ),
            array(
                'categories_id' => Categories::PERFORMANCE_ART,
                'types_id' => Types::AUDIO,
            ),
            array(
                'categories_id' => Categories::PERFORMANCE_ART,
                'types_id' => Types::VIDEO,
            ),
            array(
                'categories_id' => Categories::WRITTEN_ART,
                'types_id' => Types::TEXT,
            ),
            array(
                'categories_id' => Categories::BODY_ART,
                'types_id' => Types::IMAGE,
            ),
            array(
                'categories_id' => Categories::BODY_ART,
                'types_id' => Types::VIDEO,
            ),
        );

        foreach($categories_posts_types as $categories_posts_type)
        {
            try
            {
                // Insert categories posts type
                DB::table('categories_posts_types')->insert(array($categories_posts_type));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $categories_id = $categories_posts_type['categories_id'];
                $types_id = $categories_posts_type['types_id'];

                // Print duplicate error message to console
                echo "Categories posts type ($categories_id, $types_id) already exsists in the database, skipping...\n";
            }
        }
    }
}
