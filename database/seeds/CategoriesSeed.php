<?php

use Illuminate\Database\Seeder;

use App\Http\Helpers\Constants\Categories;

class CategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array(
                'id' => Categories::MUSIC,
                'name' => 'Music',
                'parent_id' => null,
                'color' => 'red',
            ),
            array(
                'id' => Categories::VISUAL_ART_2D,
                'name' => 'Visual Art (2D)',
                'parent_id' => null,
                'color' => 'violet',
            ),
            array(
                'id' => Categories::VISUAL_ART_3D,
                'name' => 'Visual Art (3D)',
                'parent_id' => null,
                'color' => 'indigo',
            ),
            array(
                'id' => Categories::DIGITAL_ART,
                'name' => 'Digital Art',
                'parent_id' => null,
                'color' => 'blue',
            ),
            array(
                'id' => Categories::PERFORMANCE_ART,
                'name' => 'Performance Art',
                'parent_id' => null,
                'color' => 'orange',
            ),
            array(
                'id' => Categories::WRITTEN_ART,
                'name' => 'Written Art',
                'parent_id' => null,
                'color' => 'green',
            ),
            array(
                'id' => Categories::BODY_ART,
                'name' => 'Body Art',
                'parent_id' => null,
                'color' => 'yellow',
            ),
            array(
                'id' => Categories::EDM,
                'name' => 'EDM',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::RAP_HIP_HOP,
                'name' => 'Rap/Hip-Hop',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::R_AND_B,
                'name' => 'R&B',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::POP,
                'name' => 'Pop',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::INDIE,
                'name' => 'Indie',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::REGGAE,
                'name' => 'Reggae',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::ALTERNATIVE,
                'name' => 'Alternative',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::ROCK,
                'name' => 'Rock',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::METAL,
                'name' => 'Metal',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
            array(
                'id' => Categories::PHOTOGRAPHY,
                'name' => 'Photography',
                'parent_id' => Categories::DIGITAL_ART,
                'color' => null,
            ),
            array(
                'id' => Categories::GRAPHIC_DESIGN,
                'name' => 'Graphic Design',
                'parent_id' => Categories::DIGITAL_ART,
                'color' => null,
            ),
            array(
                'id' => Categories::VIDEOGRAPHY,
                'name' => 'Videography',
                'parent_id' => Categories::DIGITAL_ART,
                'color' => null,
            ),
            array(
                'id' => Categories::PUNK,
                'name' => 'Punk',
                'parent_id' => Categories::MUSIC,
                'color' => null,
            ),
        );

        foreach($categories as $category)
        {
            // Set parent color for sub categories
            if(is_null($category['color']))
            {
                $category['color'] = $categories[$category['parent_id'] - 1]['color'];
            }

            try
            {
                // Insert category
                DB::table('categories')->insert(array($category));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $id = $category['id'];
                $name = $category['name'];

                // Print duplicate error message to console
                echo "Category $id ($name) already exsists in the database, skipping...\n";
            }
        }
    }
}
