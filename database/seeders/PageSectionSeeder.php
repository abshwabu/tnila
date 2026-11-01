<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PageSection;
use App\Support\SectionTypes;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'key' => 'hero',
                'type' => SectionTypes::HERO,
                'sort_order' => 1,
                'is_visible' => true,
                'nav_label' => 'Home',
                'anchor' => 'hero',
                'content' => [
                    'eyebrow' => 'Construction, handled with care',
                    'heading' => 'Build with a team that keeps the process calm, clear, and on schedule.',
                    'subheading' => 'From residential homes to industrial works, we help clients shape projects that feel well planned from the first conversation to handover.',
                    'cta_primary_label' => 'Get a quote',
                    'cta_primary_url' => '/contact',
                    'cta_secondary_label' => 'View projects',
                    'cta_secondary_url' => '/projects',
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'l',
                ],
            ],
            [
                'key' => 'services',
                'type' => SectionTypes::SERVICES,
                'sort_order' => 2,
                'is_visible' => true,
                'nav_label' => 'Services',
                'anchor' => 'services',
                'content' => [
                    'eyebrow' => 'Services',
                    'heading' => 'What we do best',
                    'subheading' => 'Comprehensive construction capabilities delivered with discipline and craftsmanship.',
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'industries',
                'type' => SectionTypes::ABOUT,
                'sort_order' => 3,
                'is_visible' => true,
                'nav_label' => 'Industries',
                'anchor' => 'industries',
                'content' => [
                    'eyebrow' => 'Industries',
                    'heading' => 'Four sectors, one dependable process',
                    'subheading' => 'Proven expertise across residential, commercial, industrial, and infrastructure developments.',
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'projects',
                'type' => SectionTypes::PROJECTS,
                'sort_order' => 4,
                'is_visible' => true,
                'nav_label' => 'Projects',
                'anchor' => 'projects',
                'content' => [
                    'eyebrow' => 'Featured projects',
                    'heading' => 'Selected work that speaks for itself',
                    'subheading' => 'Explore builds completed on time, within budget, and to exacting specifications.',
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'testimonials',
                'type' => SectionTypes::TESTIMONIALS,
                'sort_order' => 5,
                'is_visible' => true,
                'nav_label' => 'Reviews',
                'anchor' => 'testimonials',
                'content' => [
                    'eyebrow' => 'Client feedback',
                    'heading' => 'Trusted by developers, homeowners, and public leaders',
                    'subheading' => 'What our clients say about project communication, speed, and finish quality.',
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'cta_banner',
                'type' => SectionTypes::CTA_BANNER,
                'sort_order' => 6,
                'is_visible' => true,
                'nav_label' => 'Get Started',
                'anchor' => 'start',
                'content' => [
                    'eyebrow' => "Let's build",
                    'heading' => 'Ready to start your project?',
                    'subheading' => 'Tell us what you are planning and we will help shape the next step.',
                    'primary_label' => 'Get a quote',
                    'primary_url' => '/contact',
                    'secondary_label' => 'Start your project',
                    'secondary_url' => '/services',
                ],
                'style' => [
                    'background_type' => 'color',
                    'background_color' => '#0f172a',
                    'text_theme' => 'light',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'blog',
                'type' => SectionTypes::BLOG,
                'sort_order' => 7,
                'is_visible' => true,
                'nav_label' => 'Insights',
                'anchor' => 'blog',
                'content' => [
                    'eyebrow' => 'From the blog',
                    'heading' => 'Recent thinking, tips, and project updates',
                    'subheading' => 'Insights from the field on construction methods, scheduling, and engineering.',
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'contact',
                'type' => SectionTypes::CONTACT,
                'sort_order' => 8,
                'is_visible' => true,
                'nav_label' => 'Contact',
                'anchor' => 'contact',
                'content' => [
                    'eyebrow' => 'Contact',
                    'heading' => 'Start a conversation about your next project',
                    'subheading' => 'Whether you need a quote, a follow-up on a service, or a discussion about an upcoming build, we’d love to hear from you.',
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
        ];

        foreach ($sections as $sectionData) {
            PageSection::query()->updateOrCreate(
                ['key' => $sectionData['key']],
                $sectionData
            );
        }
    }
}
