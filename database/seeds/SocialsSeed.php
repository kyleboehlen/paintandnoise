<?php

use Illuminate\Database\Seeder;

// Helpers
use App\Http\Helpers\Constants\Socials;
use App\Http\Helpers\Functions\SeedHelper;

// Models
use App\Models\Socials\Socials as SocialModel;

class SocialsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socials = array(
            array(
                'id' => Socials::FACEBOOK,
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com',
                'icon_identifier' => 'facebook',
                'profile_link_pattern' => '{url}/{username}',
            ),
            array(
                'id' => Socials::TWITTER,
                'name' => 'Twitter',
                'url' => 'https://twitter.com',
                'icon_identifier' => 'twitter',
                'profile_link_pattern' => '{url}/{username}',
            ),
            array(
                'id' => Socials::INSTAGRAM,
                'name' => 'Instagram',
                'url' => 'https://www.instagram.com',
                'icon_identifier' => 'instagram',
                'profile_link_pattern' => '{url}/{username}',
            ),
            array(
                'id' => Socials::YOUTUBE,
                'name' => 'Youtube',
                'url' => 'https://www.youtube.com',
                'icon_identifier' => 'youtube',
                'profile_link_pattern' => '{url}/user/{username}',
            ),
            array(
                'id' => Socials::SOUNDCLOUD,
                'name' => 'Soundcloud',
                'url' => 'https://soundcloud.com',
                'icon_identifier' => 'soundcloud',
                'profile_link_pattern' => '{url}/{username}',
            ),
            array(
                'id' => Socials::SPOTIFY,
                'name' => 'Spotify',
                'url' => 'https://open.spotify.com',
                'icon_identifier' => 'spotify',
                'profile_link_pattern' => '{url}/{type}/{uid}',
            ),
        );

        $failures = 0;
        foreach($socials as $social)
        {
            $social_model = SocialModel::find($social['id']);

            if(!is_null($social_model))
            {
                $social_model->fill($social);
            }
            else
            {
                $social_model = new SocialModel($social);
            }

            // Error handling if model fails to save
            if(!$social_model->save())
            {
                $failures++;

                // Log error
                $id = $social['id'];
                $name = $social['name'];
                Log::error("Failed to seed social $id ($name)");
            }
        }

        // Print failures
        SeedHelper::printFailures($failures);
    }
}
