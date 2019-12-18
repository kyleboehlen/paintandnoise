<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Categories\UsersCategories;
use App\Model;
use Faker\Generator as Faker;

// Models
use App\Models\Users;
use App\Models\Categories\Categories;

$factory->define(UsersCategories::class, function (Faker $faker) {
    return [
        'categories_id' => Categories::all()->random()->id,
        'users_id' => Users::all()->random()->id,
    ];
});
