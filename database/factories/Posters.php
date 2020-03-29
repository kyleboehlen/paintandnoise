<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Posters\Posters;
use App\Models\Users;
use Faker\Generator as Faker;

$factory->define(Posters::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'users_id' => $faker->unique()->numberBetween(1, Users::all()->count()),
        'status_id' => 1, // Approved
        'bio' => $faker->text($maxChars = 255),
        'verification_token' => $faker->regexify('[a-zA-Z0-9]{6}'),
    ];
});
