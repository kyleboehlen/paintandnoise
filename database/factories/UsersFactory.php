<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

// Models
use App\Models\Users;

class UsersFactory extends Factory
{
    protected $model = Users::class;

    public function definition()
    {
        $test_pic = rand(0, 12);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'profile_picture' => "/test/$test_pic.jpg",
            'zip_code' => rand(0, 3) ? null : substr($this->faker->postcode, 0, 5), // 75% of users will have a zip code
        ];
    }
}