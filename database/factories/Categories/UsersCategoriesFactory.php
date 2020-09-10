<?php

namespace Database\Factories\Categories;

use Illuminate\Database\Eloquent\Factories\Factory;

// Models
use App\Models\Categories\UsersCategories;
use App\Models\Users;
use App\Models\Categories\Categories;

class UsersCategoriesFactory extends Factory
{
    protected $model = UsersCategories::class;

    public function definition()
    {
        return [
            'categories_id' => Categories::all()->random()->id,
            'users_id' => Users::all()->random()->id,
        ];
    }
}