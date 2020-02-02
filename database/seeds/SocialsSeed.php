<?php

use Illuminate\Database\Seeder;

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
                'id' => 1,
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com',
                'icon_identifier' => 'facebook',
                'profile_link_pattern' => '{url}/{username}',
            ),
            array(
                'id' => 2,
                'name' => 'Twitter',
                'url' => 'https://twitter.com',
                'icon_identifier' => 'twitter',
                'profile_link_pattern' => '{url}/{username}',
            ),
            array(
                'id' => 3,
                'name' => 'Instagram',
                'url' => 'https://www.instagram.com',
                'icon_identifier' => 'instagram',
                'profile_link_pattern' => '{url}/{username}',
            ),
            array(
                'id' => 4,
                'name' => 'Youtube',
                'url' => 'https://www.youtube.com',
                'icon_identifier' => 'youtube',
                'profile_link_pattern' => '{url}/user/{username}',
            ),
            array(
                'id' => 5,
                'name' => 'Soundcloud',
                'url' => 'https://soundcloud.com',
                'icon_identifier' => 'soundcloud',
                'profile_link_pattern' => '{url}/{username}',
            ),
            array(
                'id' => 6,
                'name' => 'Spotify',
                'url' => 'https://open.spotify.com/',
                'icon_identifier' => 'spotify',
                'profile_link_pattern' => '{url}/artist/{uid}',
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
