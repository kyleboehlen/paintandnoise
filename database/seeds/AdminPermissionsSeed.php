<?php

use Illuminate\Database\Seeder;

class AdminPermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            array(
                'id' => 1,
                'tools_id' => 1, // Admin Users Tool
                'name' => 'Create Admin',
                'description' => 'Admin User allowed to create another P&N Admin User.',
            ),
            array(
                'id' => 2,
                'tools_id' => 1, // Admin Users Tool
                'name' => 'Grant Permissions',
                'description' => 'Admin User allowed to grant admin permissions to other Admin Users.',
            ),
            array(
                'id' => 3,
                'tools_id' => 1, // Admin Users Tool
                'name' => 'Reset Password',
                'description' => 'Admin User allowed to reset another Admin Users password.',
            ),
            array(
                'id' => 4,
                'tools_id' => 1, // Admin Users Tool
                'name' => 'Delete Admin',
                'description' => 'Admin User allowed to delete other Admin Users.',
            ),
            array(
                'id' => 5,
                'tools_id' => 1, // Admin Users Tool
                'name' => 'View Admins',
                'description' => 'Admin User allowed to view the list of Admin Users.',
            ),
            array(
                'id' => 6,
                'tools_id' => 2, // Reported Posts Tool
                'name' => 'View Reported Posts',
                'description' => 'Admin User allowed to view a list of reported posts.',
            ),
            array(
                'id' => 7,
                'tools_id' => 2, // Reported Posts Tool
                'name' => 'Resolve Reported Posts',
                'description' => 'Admin User allowed whitelist and blacklist reported posts.',
            ),
            array(
                'id' => 8,
                'tools_id' => 3, // Posters Tool
                'name' => 'View Posters',
                'description' => 'Admin User allowed to view a list of verified posters.',
            ),
            array(
                'id' => 9,
                'tools_id' => 3, // Posters Tool
                'name' => 'View Poster Requests',
                'description' => 'Admin User allowed to view a list of requests for posters to become verified or change poster profile details.',
            ),
            array(
                'id' => 10,
                'tools_id' => 3, // Posters Tool
                'name' => 'Resolve Poster Requests',
                'description' => 'Admin User allowed to approve/deny verified poster requests and changes to poster profile details.',
            ),
            array(
                'id' => 11,
                'tools_id' => 4, // Stats Tool
                'name' => 'View App Stats',
                'description' => 'Admin User allowed to view stats about the app status and such.',
            ),
        );

        foreach($permissions as $permission)
        {
            try
            {
                // Insert admin permission
                DB::table('admin_permissions')->insert(array($permission));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $id = $permission['id'];
                $name = $permission['name'];

                // Print duplicate error message to console
                echo "Admin permission $id ($name) already exsists in the database, skipping...\n";
            }
        }
    }
}
