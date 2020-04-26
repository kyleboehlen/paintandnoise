<?php

use Illuminate\Database\Seeder;

// Constant Helpers
use App\Http\Helpers\Constants\Admin\Tools;

class AdminToolsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tools = array(
            array(
                'id' => Tools::ADMIN_USERS,
                'name' => 'Admin Users',
                'route_name' => 'admin.users',
            ),
            array(
                'id' => Tools::REPORTED_POSTS,
                'name' => 'Reported Posts',
                'route_name' => 'admin.reported-posts',
            ),
            array(
                'id' => Tools::POSTERS,
                'name' => 'Posters',
                'route_name' => 'admin.posters',
            ),
            array(
                'id' => Tools::STATS,
                'name' => 'Stats',
                'route_name' => 'admin.stats',
            ),
        );

        foreach($tools as $tool)
        {
            try
            {
                // Insert admin tool
                DB::table('admin_tools')->insert(array($tool));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $id = $tool['id'];
                $name = $tool['name'];

                // Print duplicate error message to console
                echo "Admin tool $id ($name) already exsists in the database, skipping...\n";
            }
        }
    }
}
