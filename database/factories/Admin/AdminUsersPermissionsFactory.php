<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

// Models
use App\Models\Admin\AdminUsersPermissions;
use App\Models\Admin\AdminUsers;
use App\Models\Admin\AdminPermissions;

class AdminUsersPermissionsFactory extends Factory
{
    protected $model = AdminUsersPermissions::class;

    public function definition()
    {
        return [
            'users_id' => AdminUsers::all()->random()->id,
            'permissions_id' => AdminPermissions::all()->random()->id,
        ];
    }
}
