<?php

use Illuminate\Database\Seeder;

class PostsTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
            array(
                'id' => 1,
                'name' => 'Image',
            ),
            array(
                'id' => 2,
                'name' => 'Audio',
            ),
            array(
                'id' => 3,
                'name' => 'Video',
            ),
        );

        foreach($types as $type)
        {
            try
            {
                // Insert types
                DB::table('posts_types')->insert(array($type));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $id = $type['id'];
                $name = $type['name'];

                // Print duplicate error message to console
                echo "Posts type $id ($name) already exsists in the database, skipping...\n";
            }
        }
    }
}
