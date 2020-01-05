<?php

use Illuminate\Database\Seeder;

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
                'id' => 1,
                'name' => 'Admin Users',
                'route_name' => 'admin.users',
            ),
            array(
                'id' => 2,
                'name' => 'Reported Posts',
                'route_name' => 'admin.reported-posts',
            ),
            array(
                'id' => 3,
                'name' => 'Posters',
                'route_name' => 'admin.posters',
            ),
            array(
                'id' => 4,
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
