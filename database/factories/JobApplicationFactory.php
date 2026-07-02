<?php

namespace Database\Factories;

use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobApplication>
 */
class JobApplicationFactory extends Factory
{
    protected $model = JobApplication::class;

    public function definition(): array
    {
        return [
            'job_listing_id' => JobListing::factory(),
            'applicant_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'resume' => 'resumes/' . fake()->uuid() . '.pdf',
            'cover_letter' => fake()->boolean(80) ? fake()->paragraphs(2, true) : null,
            'status' => fake()->randomElement(['new', 'reviewed', 'interviewing', 'rejected', 'hired']),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
