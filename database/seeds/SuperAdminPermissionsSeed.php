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

        $duplicates = 0;
        $new_permissions = 0;
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

                // If it doesn't fail, increment new permissions counter and log the addition
                $new_permissions++;
                Log::info("Added Super Admin permission $id ($name)");
            }
            catch(\Exception $e)
            {
                $duplicates++;

                // Log duplicate
                $id = $permission->id;
                $name = $permission->name;
                Log::warning("Super Admin already has permission $id ($name)");
            }
        }

        if($new_permissions > 0)
        {
            echo "\e[32mNew Permissions:\e[0m see info log for details ($new_permissions new permissions)\n";
        }

        if($duplicates > 0)
        {
            echo "\e[31mDuplicates:\e[0m see warning log for details ($duplicates duplicate permissions)\n";
        }
    }
}
