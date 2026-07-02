<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'author_name' => fake()->name(),
            'author_role' => fake()->jobTitle(),
            'company' => fake()->company(),
            'content' => fake()->paragraphs(2, true),
            'rating' => fake()->numberBetween(4, 5),
            'project_id' => Project::factory(),
            'featured' => fake()->boolean(25),
            'approved' => fake()->boolean(80),
        ];
    }
}
