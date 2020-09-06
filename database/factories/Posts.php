<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Categories\Categories;
use App\Models\Posts\Posts;
use App\Models\Posters\Posters;
use App\Models\Posters\PostersCategories;
use Faker\Generator as Faker;

$factory->define(Posts::class, function (Faker $faker) {
    $poster = Posters::whereNotIn('users_id', Posts::all()->pluck('users_id')->toArray())->get()->random();
    $categories = PostersCategories::where('posters_id', $poster->id)->get();
    $categories_id = $categories->random()->categories_id;
    $categories_posts_types = Categories::find($categories_id)->postsTypesIds();
    $types_id = $categories_posts_types[array_rand($categories_posts_types)];
    $asset_array = config('test.assets');

    return [
        'id' => $faker->uuid,
        'posters_id' => $poster->id,
        'categories_id' => $categories_id,
        'types_id' => $types_id,
        'asset' => json_encode($asset_array[$types_id]),
        'nsfw' => random_int(0, 1),
        'vote_token' => $faker->regexify('[a-zA-Z0-9]{16}'),
    ];
});
