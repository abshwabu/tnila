<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faq>
 */
class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition(): array
    {
        return [
            'question' => fake()->sentence(8) . '?',
            'answer' => fake()->paragraphs(2, true),
            'category' => fake()->randomElement(['Services', 'Projects', 'Process', 'Billing']),
            'order' => fake()->numberBetween(1, 20),
        ];
    }
}
