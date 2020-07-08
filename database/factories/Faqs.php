<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faqs;
use Faker\Generator as Faker;

$factory->define(Faqs::class, function (Faker $faker) {
    return [
        'question' => $faker->question(),
        'answer' => $faker->paragraph(),
    ];
});
