<?php

use Illuminate\Database\Seeder;

// Constant Helpers
use App\Http\Helpers\Constants\Socials;

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

        foreach($socials as $social)
        {
            try
            {
                // Insert social
                DB::table('socials')->insert(array($social));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $id = $social['id'];
                $name = $social['name'];

                // Print duplicate error message to console
                echo "Social $id ($name) already exsists in the database, skipping...\n";
            }
        }
    }
}
