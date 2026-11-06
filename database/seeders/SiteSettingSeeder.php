<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'branding' => [
                    'site_name' => 'Tnela',
                    'tagline' => 'Construction Company',
                    'logo_light' => null,
                    'logo_dark' => null,
                    'favicon' => null,
                    'footer_logo' => null,
                ],
                'theme' => [
                    'primary' => '#f59e0b',
                    'secondary' => '#0f172a',
                    'accent' => '#ea7f22',
                    'background' => '#fffcf7',
                    'surface' => '#ffffff',
                    'text' => '#0f172a',
                    'heading_font' => 'Sora',
                    'body_font' => 'Inter',
                    'corner_radius' => 'soft',
                    'radius_style' => 'rounded-xl',
                ],
                'contact' => [
                    'email' => 'info@tnela.test',
                    'notification_email' => null,
                    'phone' => '+254 700 000 000',
                    'secondary_phone' => '+254 711 000 000',
                    'address' => 'Addis Ababa, Ethiopia',
                    'map_embed_url' => null,
                    'working_hours' => 'Mon - Fri: 8:00 AM - 5:00 PM',
                ],
                'social' => [
                    ['platform' => 'linkedin', 'url' => 'https://www.linkedin.com'],
                    ['platform' => 'instagram', 'url' => 'https://www.instagram.com'],
                    ['platform' => 'x', 'url' => 'https://x.com'],
                ],
                'navigation' => [
                    'items' => [
                        ['label' => 'Home', 'type' => 'route', 'url' => '/', 'open_in_new_tab' => false],
                        ['label' => 'About', 'type' => 'route', 'url' => '/about', 'open_in_new_tab' => false],
                        ['label' => 'Services', 'type' => 'route', 'url' => '/services', 'open_in_new_tab' => false],
                        ['label' => 'Industries', 'type' => 'route', 'url' => '/industries', 'open_in_new_tab' => false],
                        ['label' => 'Projects', 'type' => 'route', 'url' => '/projects', 'open_in_new_tab' => false],
                        ['label' => 'Blog', 'type' => 'route', 'url' => '/blog', 'open_in_new_tab' => false],
                        ['label' => 'Careers', 'type' => 'route', 'url' => '/careers', 'open_in_new_tab' => false],
                        ['label' => 'FAQs', 'type' => 'route', 'url' => '/faqs', 'open_in_new_tab' => false],
                    ],
                    'cta_label' => 'Start a project',
                    'cta_url' => '/contact',
                    'cta_open_in_new_tab' => false,
                ],
                'seo' => [
                    'meta_title' => 'Tnela | Construction Company',
                    'meta_description' => 'Tnela delivers construction projects across residential, commercial, industrial, and infrastructure sectors with calm execution and clear communication.',
                    'og_image' => null,
                    'twitter_handle' => '@tnelaconstruct',
                    'analytics_snippet' => null,
                ],
                'footer' => [
                    'about_blurb' => 'Building durable spaces with calm execution and clear communication. We deliver residential, commercial, industrial, and infrastructure projects with the kind of process clients can trust.',
                    'copyright_text' => 'Tnela. All rights reserved.',
                    'legal_links' => [
                        ['label' => 'Privacy Policy', 'url' => '#', 'open_in_new_tab' => false],
                        ['label' => 'Terms of Service', 'url' => '#', 'open_in_new_tab' => false],
                        ['label' => 'Safety & Compliance', 'url' => '#', 'open_in_new_tab' => false],
                    ],
                ],
            ]
        );
    }
}
