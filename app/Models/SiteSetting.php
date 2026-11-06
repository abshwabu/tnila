<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\FlushesSiteCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class SiteSetting extends Model
{
    use FlushesSiteCache, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'branding',
        'theme',
        'contact',
        'social',
        'navigation',
        'seo',
        'footer',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'branding' => 'array',
            'theme' => 'array',
            'contact' => 'array',
            'social' => 'array',
            'navigation' => 'array',
            'seo' => 'array',
            'footer' => 'array',
        ];
    }

    /**
     * Retrieve the singleton site settings instance, initializing with defaults if missing.
     */
    public static function current(): self
    {
        try {
            /** @var self|null $settings */
            $settings = static::query()->first();

            if ($settings !== null) {
                return $settings;
            }
        } catch (Throwable) {
            // Database not yet migrated or table unavailable
        }

        return new self([
            'branding' => [
                'site_name' => 'Tnela',
                'tagline' => 'Construction Company',
                'logo_light' => null,
                'logo_dark' => null,
                'favicon' => null,
                'footer_logo' => null,
            ],
            'theme' => [
                'primary' => '#d97706',
                'secondary' => '#0f172a',
                'accent' => '#f59e0b',
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
                'secondary_phone' => null,
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
                'meta_description' => 'Tnela delivers construction projects across residential, commercial, industrial, and infrastructure sectors.',
                'og_image' => null,
                'twitter_handle' => null,
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
        ]);
    }
}
