<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// Models
use App\Models\Faqs;

class FaqsFactory extends Factory
{
    protected $model = Faqs::class;

    public function definition()
    {
        return [
            'question' => $this->faker->question(),
            'answer' => $this->faker->paragraph(),
        ];
    }
}
