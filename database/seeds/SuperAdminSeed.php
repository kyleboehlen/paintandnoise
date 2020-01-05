<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            // Print duplicate error message to console
            echo "Super Admin already exsists as a user...\n";
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
            { /* Do nothing and let PHPUnit handle the failure test case */ }
        }
    }
}
