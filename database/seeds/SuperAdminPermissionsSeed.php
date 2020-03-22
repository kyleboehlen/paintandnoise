<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

// Models
use App\Models\Admin\AdminPermissions;

class SuperAdminPermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = AdminPermissions::all();

        foreach($permissions as $permission)
        {
            $array = [
                'users_id' => 1,
                'permissions_id' => $permission->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            try
            {
                // Insert admin permission
                DB::table('admin_users_permissions')->insert(array($array));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $id = $permission->id;
                $name = $permission->name;

                // Print duplicate error message to console
                echo "Super Admin already has permission $id ($name), skipping...\n";
            }
        }
    }
}
