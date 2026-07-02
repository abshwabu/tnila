<?php

namespace Database\Factories;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobListing>
 */
class JobListingFactory extends Factory
{
    protected $model = JobListing::class;

    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'department' => fake()->randomElement(['Operations', 'Projects', 'Commercial', 'Safety', 'Administration']),
            'location' => fake()->city(),
            'employment_type' => fake()->randomElement(['full_time', 'part_time', 'contract']),
            'description' => '<p>' . fake()->paragraphs(3, true) . '</p>',
            'requirements' => fake()->paragraphs(2, true),
            'status' => fake()->randomElement(['open', 'closed']),
        ];
    }
}
