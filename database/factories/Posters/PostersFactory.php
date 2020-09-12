<?php

namespace Database\Factories\Posters;

use Illuminate\Database\Eloquent\Factories\Factory;

// Models
use App\Models\Posters\Posters;
use App\Models\Users;

class PostersFactory extends Factory
{
    protected $model = Posters::class;
    private $users_count;

    public function __construct()
    {
        $this->users_count = Users::all()->count();
        parent::__construct(...func_get_args());
    }

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'users_id' => $this->faker->unique()->numberBetween(1, $this->users_count),
            'status_id' => 1, // Approved
            'bio' => $this->faker->text($maxChars = 255),
            'verification_token' => $this->faker->regexify('[a-zA-Z0-9]{6}'),
        ];
    }
}