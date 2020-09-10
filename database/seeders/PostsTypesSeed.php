<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Log;

// Helpers
use App\Http\Helpers\Constants\Posts\Types;
use App\Http\Helpers\Functions\SeedHelper;

// Models
use App\Models\Posts\PostsTypes;

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

        $failures = 0;
        foreach($types as $type)
        {
            $post_type = PostsTypes::find($type['id']);

            if(!is_null($post_type))
            {
                $post_type->fill($type);
            }
            else
            {
                $post_type = new PostsTypes($type);
            }

            // Error handling if model fails to save
            if(!$post_type->save())
            {
                $failures++;

                // Log Error
                $id = $type['id'];
                $name = $type['name'];
                Log::error("Failed to seed posts type $id ($name)");
            }
        }

        // Print failures
        SeedHelper::printFailures($failures);
    }
}
