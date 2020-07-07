<?php

use Illuminate\Database\Seeder;

// Helpers
use App\Http\Helpers\Constants\Admin\Tools;
use App\Http\Helpers\Constants\Admin\Permissions;
use App\Http\Helpers\Functions\SeedHelper;

// Models
use App\Models\Admin\AdminPermissions;

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
                'id' => Permissions::CREATE_ADMIN,
                'tools_id' => Tools::ADMIN_USERS,
                'name' => 'Create Admin',
                'description' => 'Admin User allowed to create another P&N Admin User.',
            ),
            array(
                'id' => Permissions::GRANT_PERMISSIONS,
                'tools_id' => Tools::ADMIN_USERS,
                'name' => 'Grant Permissions',
                'description' => 'Admin User allowed to grant admin permissions to other Admin Users.',
            ),
            array(
                'id' => Permissions::RESET_PASSWORD,
                'tools_id' => Tools::ADMIN_USERS,
                'name' => 'Reset Password',
                'description' => 'Admin User allowed to reset another Admin Users password.',
            ),
            array(
                'id' => Permissions::DELETE_ADMIN,
                'tools_id' => Tools::ADMIN_USERS,
                'name' => 'Delete Admin',
                'description' => 'Admin User allowed to delete other Admin Users.',
            ),
            array(
                'id' => Permissions::VIEW_ADMIN,
                'tools_id' => Tools::ADMIN_USERS,
                'name' => 'View Admins',
                'description' => 'Admin User allowed to view the list of Admin Users.',
            ),
            array(
                'id' => Permissions::VIEW_REPORTED_POSTS,
                'tools_id' => Tools::REPORTED_POSTS,
                'name' => 'View Reported Posts',
                'description' => 'Admin User allowed to view a list of reported posts.',
            ),
            array(
                'id' => Permissions::RESOLVE_REPORTED_POSTS,
                'tools_id' => Tools::REPORTED_POSTS,
                'name' => 'Resolve Reported Posts',
                'description' => 'Admin User allowed whitelist and blacklist reported posts.',
            ),
            array(
                'id' => Permissions::VIEW_POSTERS,
                'tools_id' => Tools::POSTERS,
                'name' => 'View Posters',
                'description' => 'Admin User allowed to view a list of verified posters.',
            ),
            array(
                'id' => Permissions::VIEW_POSTERS_REQUESTS,
                'tools_id' => Tools::POSTERS,
                'name' => 'View Poster Requests',
                'description' => 'Admin User allowed to view a list of requests for posters to become verified or change poster profile details.',
            ),
            array(
                'id' => Permissions::RESOLVE_POSTERS_REQUESTS,
                'tools_id' => Tools::POSTERS,
                'name' => 'Resolve Poster Requests',
                'description' => 'Admin User allowed to approve/deny verified poster requests and changes to poster profile details.',
            ),
            array(
                'id' => Permissions::VIEW_APP_STATS,
                'tools_id' => Tools::STATS,
                'name' => 'View App Stats',
                'description' => 'Admin User allowed to view stats about the app status and such.',
            ),
            array(
                'id' => Permissions::MANAGE_FAQS,
                'tools_id' => Tools::FAQS,
                'name' => 'Manage FAQs',
                'description' => 'Admin User allowed to create, update, and delete FAQs.',
            ),
        );

        $failures = 0;
        foreach($permissions as $permission)
        {
            $admin_permission = AdminPermissions::find($permission['id']);
            
            if(!is_null($admin_permission))
            {
                $admin_permission->fill($permission);
            }
            else
            {
                $admin_permission = new AdminPermissions($permission);
            }

            // Error handling if model fails to save
            if(!$admin_permission->save())
            {
                $failures++;

                // Log Error
                $id = $permission['id'];
                $name = $permission['name'];
                Log::error("Failed to seed admin permission: $id ($name)");
            }

            // Print failures
            SeedHelper::printFailures($failures);
        }
    }
}
