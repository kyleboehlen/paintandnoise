<?php

use Illuminate\Database\Seeder;

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
                'id' => 1,
                'name' => 'Music',
                'parent_id' => null,
                'color' => 'red',
            ),
            array(
                'id' => 2,
                'name' => 'Visual Art (2D)',
                'parent_id' => null,
                'color' => 'violet',
            ),
            array(
                'id' => 3,
                'name' => 'Visual Art (3D)',
                'parent_id' => null,
                'color' => 'indigo',
            ),
            array(
                'id' => 4,
                'name' => 'Digital Art',
                'parent_id' => null,
                'color' => 'blue',
            ),
            array(
                'id' => 5,
                'name' => 'Performance Art',
                'parent_id' => null,
                'color' => 'orange',
            ),
            array(
                'id' => 6,
                'name' => 'Written Art',
                'parent_id' => null,
                'color' => 'green',
            ),
            array(
                'id' => 7,
                'name' => 'Body Art',
                'parent_id' => null,
                'color' => 'yellow',
            ),
            array(
                'id' => 8,
                'name' => 'EDM',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 9,
                'name' => 'Rap/Hip-Hop',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 10,
                'name' => 'R&B',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 11,
                'name' => 'Pop',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 12,
                'name' => 'Indie',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 13,
                'name' => 'Reggae',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 14,
                'name' => 'Alternative',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 15,
                'name' => 'Rock',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 16,
                'name' => 'Metal',
                'parent_id' => 1, // Music
                'color' => null,
            ),
            array(
                'id' => 17,
                'name' => 'Photography',
                'parent_id' => 4, // Digital Art
                'color' => null,
            ),
            array(
                'id' => 18,
                'name' => 'Graphic Design',
                'parent_id' => 4, // Digital Art
                'color' => null,
            ),
            array(
                'id' => 19,
                'name' => 'Vidography',
                'parent_id' => 4, // Digital Art
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
