<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\AdminUsersPermissions;
use Faker\Generator as Faker;

// Models
use App\Models\Admin\AdminUsers;
use App\Models\Admin\AdminPermissions;

$factory->define(AdminUsersPermissions::class, function (Faker $faker) {
    return [
        'users_id' => AdminUsers::all()->random()->id,
        'permissions_id' => AdminPermissions::all()->random()->id,
    ];
});
