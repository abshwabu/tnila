<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\Customer;
use App\Models\Faq;
use App\Models\Industry;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::query()->updateOrCreate(
            ['email' => 'admin@tnila.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        if (Schema::hasTable(config('permission.table_names.roles', 'roles'))) {
            $adminRole = Role::findOrCreate('Admin');
            $adminUser->syncRoles([$adminRole]);
        }

        $industries = collect([
            Industry::query()->updateOrCreate(
                ['name' => 'Residential'],
                ['description' => 'Homes, apartment buildings, and living communities.', 'icon' => 'home']
            ),
            Industry::query()->updateOrCreate(
                ['name' => 'Commercial'],
                ['description' => 'Retail, office, and hospitality projects.', 'icon' => 'building-office-2']
            ),
            Industry::query()->updateOrCreate(
                ['name' => 'Industrial'],
                ['description' => 'Factories, plants, storage, and logistics facilities.', 'icon' => 'cpu-chip']
            ),
            Industry::query()->updateOrCreate(
                ['name' => 'Infrastructure'],
                ['description' => 'Roads, utilities, public works, and civil projects.', 'icon' => 'truck']
            ),
        ]);

        $customers = Customer::factory()->count(20)->create();

        Service::factory()->count(8)->create();

        $projectFixtures = [
            ['title' => 'Oakridge Apartments', 'location' => 'Nairobi', 'status' => 'completed', 'featured' => true, 'industry' => 'Residential'],
            ['title' => 'Horizon Villas', 'location' => 'Kiambu', 'status' => 'in_progress', 'featured' => true, 'industry' => 'Residential'],
            ['title' => 'Nile Business Tower', 'location' => 'Nairobi', 'status' => 'planning', 'featured' => false, 'industry' => 'Commercial'],
            ['title' => 'Metro Logistics Hub', 'location' => 'Mombasa', 'status' => 'completed', 'featured' => false, 'industry' => 'Industrial'],
            ['title' => 'County Access Road Upgrade', 'location' => 'Nakuru', 'status' => 'in_progress', 'featured' => true, 'industry' => 'Infrastructure'],
            ['title' => 'Summit Heights Phase 2', 'location' => 'Nairobi', 'status' => 'planning', 'featured' => false, 'industry' => 'Residential'],
            ['title' => 'Ridgeview Office Park', 'location' => 'Eldoret', 'status' => 'completed', 'featured' => false, 'industry' => 'Commercial'],
            ['title' => 'Sunrise Cold Storage', 'location' => 'Thika', 'status' => 'completed', 'featured' => false, 'industry' => 'Industrial'],
            ['title' => 'Water Pipeline Extension', 'location' => 'Machakos', 'status' => 'in_progress', 'featured' => true, 'industry' => 'Infrastructure'],
            ['title' => 'Palm Court Residences', 'location' => 'Nairobi', 'status' => 'completed', 'featured' => false, 'industry' => 'Residential'],
            ['title' => 'Cedar Mall Fit-Out', 'location' => 'Mombasa', 'status' => 'planning', 'featured' => false, 'industry' => 'Commercial'],
            ['title' => 'Northgate Workshop', 'location' => 'Kisumu', 'status' => 'in_progress', 'featured' => false, 'industry' => 'Industrial'],
            ['title' => 'Bridge Reinforcement Works', 'location' => 'Nakuru', 'status' => 'completed', 'featured' => false, 'industry' => 'Infrastructure'],
            ['title' => 'Blue Ridge Homes', 'location' => 'Kiambu', 'status' => 'completed', 'featured' => true, 'industry' => 'Residential'],
            ['title' => 'Harbor View Offices', 'location' => 'Mombasa', 'status' => 'planning', 'featured' => false, 'industry' => 'Commercial'],
        ];

        foreach ($projectFixtures as $index => $projectFixture) {
            Project::query()->create([
                'title' => $projectFixture['title'],
                'customer_id' => $customers[$index % $customers->count()]->id,
                'industry_id' => $industries->firstWhere('name', $projectFixture['industry'])->id,
                'description' => 'Delivered with disciplined scheduling, quality control, and on-site coordination.',
                'status' => $projectFixture['status'],
                'start_date' => now()->subMonths(18 - $index)->toDateString(),
                'end_date' => $projectFixture['status'] === 'completed' ? now()->subMonths(12 - $index)->toDateString() : null,
                'location' => $projectFixture['location'],
                'featured' => $projectFixture['featured'],
            ]);
        }

        $projectIds = Project::query()->pluck('id');

        for ($index = 0; $index < 12; $index++) {
            Testimonial::factory()->create([
                'customer_id' => $customers[$index % $customers->count()]->id,
                'project_id' => $projectIds[$index % $projectIds->count()],
                'approved' => true,
            ]);
        }

        BlogPost::factory()->count(10)->create();

        $jobListings = JobListing::factory()->count(5)->create();

        $jobListings->each(function (JobListing $jobListing): void {
            JobApplication::factory()
                ->count(collect([1, 2, 3])->random())
                ->for($jobListing)
                ->create();
        });

        ContactSubmission::factory()->count(5)->create();

        Faq::factory()->count(10)->create();
    }
}
