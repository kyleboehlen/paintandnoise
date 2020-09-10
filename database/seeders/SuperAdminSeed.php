<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Log;

// Models
use App\Models\Admin\AdminUsers;

class SuperAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = [
            'id' => 1,
            'name' => 'Super Admin',
            'email' => config('admin.super_admin.email'),
            'password' => Hash::make(config('admin.super_admin.password')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        try
        {
            // Insert super admin
            DB::table('admin_users')->insert(array($super_admin));
        }
        catch(\Exception $e)
        {
            // Log warning and print message
            Log::warning("Super Admin already exsists as a user, can not seed super admin");
            echo "\e[31mWarning:\e[0m Super Admin already exsists as a user...\n";
        }

        // Check if super admin password needs to be rehashed
        $super_admin = AdminUsers::find(1);

        if(Hash::needsRehash($super_admin->password))
        {
            try
            {
                // Insert super admin
                DB::table('admin_users')->where('id', 1)->update([
                    'password' => Hash::make(config('admin.super_admin.password')),
                    'updated_at' => Carbon::now(),
                ]);
            }
            catch(\Exception $e)
            {
                // Log error and print error message
                Log::error("Failed to rehash Super Admin password");
                echo "\e[31mFailure:\e[0m could not rehash Super Admin password...\n";
            }
        }
    }
}
