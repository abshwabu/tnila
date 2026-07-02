<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $status = fake()->randomElement(['draft', 'published']);

        return [
            'title' => fake()->unique()->sentence(6),
            'excerpt' => fake()->sentence(18),
            'content' => collect(fake()->paragraphs(4))->map(fn ($paragraph) => '<p>' . $paragraph . '</p>')->implode(''),
            'category' => fake()->randomElement(['Company News', 'Construction Tips', 'Project Spotlight', 'Safety']),
            'author_name' => fake()->name(),
            'cover_image' => fake()->boolean(80) ? 'images/blog/' . fake()->word() . '.jpg' : null,
            'published_at' => $status === 'published' ? fake()->dateTimeBetween('-1 year', 'now') : null,
            'status' => $status,
        ];
    }
}
