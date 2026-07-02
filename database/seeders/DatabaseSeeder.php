<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@tnila.test'],
            [
                'name' => 'Tnila Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        foreach ([
            [
                'name' => 'General contracting',
                'summary' => 'Reliable build delivery for commercial and residential projects.',
                'details' => 'Planning, procurement, site coordination, and handover support.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Renovation works',
                'summary' => 'Efficient upgrades for occupied and vacant properties.',
                'details' => 'Interior transformations, extensions, and structural improvements.',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ] as $service) {
            Service::query()->updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }

        foreach ([
            [
                'name' => 'Oakridge Apartments',
                'summary' => 'A modern residential apartment block with premium finishes.',
                'client' => 'Oakridge Developments',
                'location' => 'Nairobi',
                'category' => 'Residential',
                'status' => 'completed',
                'featured' => true,
                'completed_at' => now()->subMonths(3),
            ],
            [
                'name' => 'Metro Logistics Hub',
                'summary' => 'Warehouse and office build for a growing logistics client.',
                'client' => 'Metro Freight',
                'location' => 'Mombasa',
                'category' => 'Commercial',
                'status' => 'completed',
                'featured' => false,
                'completed_at' => now()->subMonths(5),
            ],
        ] as $project) {
            Project::query()->updateOrCreate(
                ['name' => $project['name']],
                $project
            );
        }

        Inquiry::query()->firstOrCreate(
            ['email' => 'hello@tnila.test'],
            [
                'name' => 'Sample Lead',
                'phone' => '+254700000000',
                'company' => 'Demo Client Ltd',
                'message' => 'We need a partner for a multi-storey residential build.',
                'status' => 'new',
            ]
        );
    }
}
