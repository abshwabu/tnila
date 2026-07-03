<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Industry;
use App\Models\JobListing;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_public_site_routes_return_ok(): void
    {
        $residential = Industry::query()->create([
            'name' => 'Residential',
            'slug' => 'residential',
            'description' => 'Residential developments',
            'icon' => 'home',
        ]);

        $commercial = Industry::query()->create([
            'name' => 'Commercial',
            'slug' => 'commercial',
            'description' => 'Commercial developments',
            'icon' => 'building-office-2',
        ]);

        Industry::query()->create([
            'name' => 'Industrial',
            'slug' => 'industrial',
            'description' => 'Industrial developments',
            'icon' => 'cpu-chip',
        ]);

        Industry::query()->create([
            'name' => 'Infrastructure',
            'slug' => 'infrastructure',
            'description' => 'Infrastructure developments',
            'icon' => 'truck',
        ]);

        $service = Service::factory()->create();
        $projectCustomer = Customer::factory()->create();
        $project = Project::query()->create([
            'title' => 'Atlas Tower',
            'customer_id' => $projectCustomer->id,
            'industry_id' => $commercial->id,
            'description' => 'A landmark commercial tower project.',
            'status' => 'completed',
            'start_date' => now()->subYear()->toDateString(),
            'end_date' => now()->subMonths(6)->toDateString(),
            'location' => 'Nairobi',
            'featured' => true,
        ]);

        $post = BlogPost::query()->create([
            'title' => 'Project Delivery Lessons',
            'slug' => 'project-delivery-lessons',
            'excerpt' => 'A short summary of what we learned on site.',
            'content' => '<p>Operational discipline drives results.</p>',
            'category' => 'Project Spotlight',
            'author_name' => 'Tnila Team',
            'cover_image' => null,
            'published_at' => now()->subDay(),
            'status' => 'published',
        ]);

        $job = JobListing::factory()->create([
            'status' => 'open',
        ]);

        Faq::factory()->create();
        Testimonial::query()->create([
            'customer_id' => $projectCustomer->id,
            'project_id' => $project->id,
            'author_name' => 'Amina Kariuki',
            'author_role' => 'Operations Director',
            'company' => 'Atlas Holdings',
            'content' => 'The team delivered reliably and communicated clearly throughout the project.',
            'rating' => 5,
            'featured' => true,
            'approved' => true,
        ]);

        $routes = [
            '/',
            '/about',
            '/about/our-story',
            '/about/mission',
            '/about/team',
            '/services',
            route('services.show', $service),
            '/industries',
            route('industries.show', $commercial),
            '/projects',
            route('projects.by-industry', $residential),
            route('projects.show', $project),
            '/testimonials',
            '/blog',
            route('blog.show', $post),
            '/careers',
            route('careers.show', $job),
            '/faqs',
            '/contact',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertOk();
        }
    }
}
