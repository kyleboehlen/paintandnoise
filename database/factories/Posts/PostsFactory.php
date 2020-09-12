<?php

namespace Database\Factories\Posts;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

// Models
use App\Models\Categories\Categories;
use App\Models\Posts\Posts;
use App\Models\Posters\Posters;
use App\Models\Posters\PostersCategories;
use App\Models\Users;

class PostsFactory extends Factory
{
    protected $model = Posts::class;
    private $categories_posts_types = array();

    public function __construct()
    {
        foreach(Categories::all() as $category)
        {
            $this->categories_posts_types[$category->id] = $category->postsTypesIds();
        }
        
        parent::__construct(...func_get_args());
    }

    public function definition()
    {
        $posts = Posts::all();

        // To handle 1 requested 0 available error
        if($posts->count() > 0)
        {
            $poster = Posters::whereNotIn('id', $posts->pluck('posters_id')->toArray())->with('categories')->with('user')->get()->random();
        }
        else
        {
            $poster = Posters::whereNotNull('id')->with('categories')->with('user')->get()->random();
        }

        // To handle some hasManyThrough just... not populating
        if($poster->categories->isEmpty())
        {
            $category =
                Categories::whereIn('id',
                    PostersCategories::where('posters_id', $poster->id)->get()->pluck('categories_id')->toArray()
                )->get()->random();
        }
        else
        {
            $category = $poster->categories->random();
        }
        $types_id = $this->categories_posts_types[$category->id][array_rand($this->categories_posts_types[$category->id])];
        $asset_array = config('test.assets');

        return [
            'id' => $this->faker->uuid,
            'posters_id' => $poster->id,
            'categories_id' => $category->id,
            'types_id' => $types_id,
            'asset' => json_encode($asset_array[$types_id]),
            'nsfw' => random_int(0, 1),
            'vote_token' => $this->faker->regexify('[a-zA-Z0-9]{16}'),
            'created_at' => Carbon::now()->subHours(rand(0, 23))->subMinutes(rand(0, 59))->subSeconds(rand(0, 59))->toDatetimeString(),
            'zip_code' => $poster->user['zip_code'],
        ];
    }
}