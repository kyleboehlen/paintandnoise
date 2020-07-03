<?php

use Illuminate\Database\Seeder;

// Helpers
use App\Http\Helpers\Constants\Categories;
use App\Http\Helpers\Functions\SeedHelper;

// Models
use App\Models\Categories\Categories as CategoryModel;

class CategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = config('categories.colors');
        $slugs = config('categories.slugs');
        $categories = array(
            array(
                'id' => Categories::MUSIC,
                'name' => 'Music',
                'parent_id' => null,
                'color' => $colors[Categories::MUSIC],
                'slug' => $slugs[Categories::MUSIC],
            ),
            array(
                'id' => Categories::VISUAL_ART_2D,
                'name' => 'Visual Art (2D)',
                'parent_id' => null,
                'color' => $colors[Categories::VISUAL_ART_2D],
                'slug' => $slugs[Categories::VISUAL_ART_2D],
            ),
            array(
                'id' => Categories::VISUAL_ART_3D,
                'name' => 'Visual Art (3D)',
                'parent_id' => null,
                'color' => $colors[Categories::VISUAL_ART_3D],
                'slug' => $slugs[Categories::VISUAL_ART_3D],
            ),
            array(
                'id' => Categories::DIGITAL_ART,
                'name' => 'Digital Art',
                'parent_id' => null,
                'color' => $colors[Categories::DIGITAL_ART],
                'slug' => $slugs[Categories::DIGITAL_ART],
            ),
            array(
                'id' => Categories::PERFORMANCE_ART,
                'name' => 'Performance Art',
                'parent_id' => null,
                'color' => $colors[Categories::PERFORMANCE_ART],
                'slug' => $slugs[Categories::PERFORMANCE_ART],
            ),
            array(
                'id' => Categories::WRITTEN_ART,
                'name' => 'Written Art',
                'parent_id' => null,
                'color' => $colors[Categories::WRITTEN_ART],
                'slug' => $slugs[Categories::WRITTEN_ART],
            ),
            array(
                'id' => Categories::BODY_ART,
                'name' => 'Body Art',
                'parent_id' => null,
                'color' => $colors[Categories::BODY_ART],
                'slug' => $slugs[Categories::BODY_ART],
            ),
            array(
                'id' => Categories::EDM,
                'name' => 'EDM',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::EDM],
            ),
            array(
                'id' => Categories::RAP_HIP_HOP,
                'name' => 'Rap/Hip-Hop',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::RAP_HIP_HOP],
            ),
            array(
                'id' => Categories::R_AND_B,
                'name' => 'R&B',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::R_AND_B],
            ),
            array(
                'id' => Categories::POP,
                'name' => 'Pop',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::POP],
            ),
            array(
                'id' => Categories::INDIE,
                'name' => 'Indie',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::INDIE],
            ),
            array(
                'id' => Categories::REGGAE,
                'name' => 'Reggae',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::REGGAE],
            ),
            array(
                'id' => Categories::ALTERNATIVE,
                'name' => 'Alternative',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::ALTERNATIVE],
            ),
            array(
                'id' => Categories::ROCK,
                'name' => 'Rock',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::ROCK],
            ),
            array(
                'id' => Categories::METAL,
                'name' => 'Metal',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::METAL],
            ),
            array(
                'id' => Categories::PHOTOGRAPHY,
                'name' => 'Photography',
                'parent_id' => Categories::DIGITAL_ART,
                'color' => null,
                'slug' => $slugs[Categories::PHOTOGRAPHY],
            ),
            array(
                'id' => Categories::GRAPHIC_DESIGN,
                'name' => 'Graphic Design',
                'parent_id' => Categories::DIGITAL_ART,
                'color' => null,
                'slug' => $slugs[Categories::GRAPHIC_DESIGN],
            ),
            array(
                'id' => Categories::VIDEOGRAPHY,
                'name' => 'Videography',
                'parent_id' => Categories::DIGITAL_ART,
                'color' => null,
                'slug' => $slugs[Categories::VIDEOGRAPHY],
            ),
            array(
                'id' => Categories::PUNK,
                'name' => 'Punk',
                'parent_id' => Categories::MUSIC,
                'color' => null,
                'slug' => $slugs[Categories::PUNK],
            ),
        );

        $failures = 0;
        foreach($categories as $category)
        {
            // Set parent color for sub categories
            if(is_null($category['color']))
            {
                $category['color'] = $categories[$category['parent_id'] - 1]['color'];
            }

            $category_model = CategoryModel::find($category['id']);

            if(!is_null($category_model))
            {
                $category_model->fill($category);
            }
            else
            {
                $category_model = new CategoryModel($category);
            }

            // Error handling if model fails to save
            if(!$category_model->save())
            {
                $failures++;

                // Log error
                $id = $category['id'];
                $name = $category['name'];
                Log::error("Failed to seed category: $id ($name)");
            }
        }

        // Print failures
        SeedHelper::printFailures($failures);
    }
}
