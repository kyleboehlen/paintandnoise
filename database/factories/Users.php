<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Users;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Users::class, function (Faker $faker) {
    $test_pic = rand(0, 12);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'profile_picture' => "/test/$test_pic.jpg",
        'zip_code' => rand(0, 3) ? null : substr($faker->postcode, 0, 5), // 75% of users will have a zip code
    ];
});
