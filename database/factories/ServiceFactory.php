<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'title' => fake()->unique()->catchPhrase(),
            'short_description' => fake()->sentence(),
            'description' => '<p>' . fake()->paragraphs(3, true) . '</p>',
            'icon' => fake()->randomElement(['home', 'building-office-2', 'wrench-screwdriver', 'truck', 'shield-check']),
            'featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(1, 20),
        ];
    }
}
