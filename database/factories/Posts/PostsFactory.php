<?php

namespace Database\Factories\Posts;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

// Models
use App\Models\Categories\Categories;
use App\Models\Posts\Posts;
use App\Models\Posters\Posters;
use App\Models\Posters\PostersCategories;

class PostsFactory extends Factory
{
    protected $model = Posts::class;

    public function definition()
    {
        $poster = Posters::whereNotIn('users_id', Posts::all()->pluck('users_id')->toArray())->get()->random();
        $categories = PostersCategories::where('posters_id', $poster->id)->get();
        $categories_id = $categories->random()->categories_id;
        $categories_posts_types = Categories::find($categories_id)->postsTypesIds();
        $types_id = $categories_posts_types[array_rand($categories_posts_types)];
        $asset_array = config('test.assets');

        return [
            'id' => $this->faker->uuid,
            'posters_id' => $poster->id,
            'categories_id' => $categories_id,
            'types_id' => $types_id,
            'asset' => json_encode($asset_array[$types_id]),
            'nsfw' => random_int(0, 1),
            'vote_token' => $this->faker->regexify('[a-zA-Z0-9]{16}'),
            'created_at' => Carbon::now()->subHours(rand(0, 23))->subMinutes(rand(0, 59))->subSeconds(rand(0, 59))->toDatetimeString(),
        ];
    }
}