<?php

use Illuminate\Database\Seeder;

// Constant Helpers
use App\Http\Helpers\Constants\Posts\Types;

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
                'id' => Types::IMAGE,
                'name' => 'Image',
            ),
            array(
                'id' => Types::AUDIO,
                'name' => 'Audio',
            ),
            array(
                'id' => Types::VIDEO,
                'name' => 'Video',
            ),
            array(
                'id' => Types::TEXT,
                'name' => 'Text',
            ),
            array(
                'id' => Types::EMBEDDED_SOUNDCLOUD,
                'name' => 'Embedded SoundCloud',
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
