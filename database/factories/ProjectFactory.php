<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Industry;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title' => fake()->unique()->company() . ' Project',
            'customer_id' => Customer::factory(),
            'industry_id' => Industry::factory(),
            'description' => fake()->paragraphs(3, true),
            'status' => fake()->randomElement(['planning', 'in_progress', 'completed']),
            'start_date' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'end_date' => fake()->boolean(70) ? fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d') : null,
            'location' => fake()->city() . ', ' . fake()->stateAbbr(),
            'featured' => fake()->boolean(30),
        ];
    }
}
