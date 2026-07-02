<?php

namespace Database\Factories;

use App\Models\ContactSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactSubmission>
 */
class ContactSubmissionFactory extends Factory
{
    protected $model = ContactSubmission::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->boolean(75) ? fake()->phoneNumber() : null,
            'message' => fake()->paragraphs(2, true),
            'source_page' => fake()->randomElement(['/', '/projects', '/services', '/contact']),
            'status' => fake()->randomElement(['new', 'contacted', 'closed']),
            'created_at' => fake()->dateTimeBetween('-90 days', 'now'),
        ];
    }
}
