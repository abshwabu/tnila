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
                    'buttons' => [
                        ['label' => 'Get a quote', 'link_type' => 'url', 'url' => '/contact', 'style' => 'primary'],
                        ['label' => 'View projects', 'link_type' => 'url', 'url' => '/projects', 'style' => 'ghost'],
                    ],
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'l',
                ],
            ],
            [
                'key' => 'about',
                'type' => SectionTypes::ABOUT,
                'sort_order' => 2,
                'is_visible' => true,
                'nav_label' => 'About',
                'anchor' => 'about',
                'content' => [
                    'eyebrow' => 'Why Tnila',
                    'heading' => 'Built for trust with straightforward updates, milestones, and documentation',
                    'subheading' => 'Established teams delivering every phase with discipline, craftsmanship, and accountability.',
                    'story_intro' => 'Tnila began with a simple idea: clients deserve construction partners who are as organized as they are capable.',
                    'mission' => 'To deliver residential, commercial, industrial, and infrastructure builds with disciplined craftsmanship, transparent scheduling, and zero guesswork.',
                    'vision' => 'To be the most trusted construction delivery firm in East Africa, setting benchmarks for structural integrity and client clarity.',
                    'story' => '<p>Tnila was established to eliminate construction uncertainty. By combining experienced field engineers with modern project coordination, we ensure that every milestone is documented, every procurement step is transparent, and every site handover meets uncompromising standards.</p>',
                    'values' => [
                        ['icon' => 'heroicon-o-shield-check', 'title' => 'Structural Integrity', 'text' => 'We adhere to the strictest engineering tolerances, quality testing, and safety protocols.'],
                        ['icon' => 'heroicon-o-clock', 'title' => 'On-Schedule Delivery', 'text' => 'Rigorous milestone tracking keeps trades aligned and handovers on time.'],
                        ['icon' => 'heroicon-o-chat-bubble-left-right', 'title' => 'Calm Communication', 'text' => 'Weekly progress photos, transparent cost accounting, and dedicated project managers.'],
                    ],
                    'buttons' => [
                        ['label' => 'Explore Our Story', 'link_type' => 'url', 'target' => null, 'url' => '/about', 'style' => 'primary'],
                    ],
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'stats',
                'type' => SectionTypes::STATS,
                'sort_order' => 3,
                'is_visible' => true,
                'nav_label' => 'Impact',
                'anchor' => 'stats',
                'content' => [
                    'eyebrow' => 'Track Record',
                    'heading' => 'Dependable construction by the numbers',
                    'subheading' => 'A track record of dependable construction across East Africa.',
                    'layout' => 'grid_4',
                    'counters' => [
                        ['value' => '12+', 'label' => 'Years Experience', 'subtext' => 'Delivering quality builds since 2014', 'icon' => 'heroicon-o-calendar'],
                        ['value' => '50+', 'label' => 'Delivered Projects', 'subtext' => 'Across 4 key sectors', 'icon' => 'heroicon-o-check-badge'],
                        ['value' => '100%', 'label' => 'Safety Compliance', 'subtext' => 'Zero critical site incidents', 'icon' => 'heroicon-o-shield-check'],
                        ['value' => '24h', 'label' => 'Client Response', 'subtext' => 'Dedicated site managers', 'icon' => 'heroicon-o-chat-bubble-left-right'],
                    ],
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'services',
                'type' => SectionTypes::SERVICES,
                'sort_order' => 4,
                'is_visible' => true,
                'nav_label' => 'Services',
                'anchor' => 'services',
                'content' => [
                    'eyebrow' => 'Services',
                    'heading' => 'What we do best',
                    'subheading' => 'Comprehensive construction capabilities delivered with discipline and craftsmanship.',
                    'layout' => 'grid_3',
                    'max_items' => 6,
                    'view_all_label' => 'View all services →',
                    'buttons' => [
                        ['label' => 'View all services', 'link_type' => 'url', 'target' => null, 'url' => '/services', 'style' => 'secondary'],
                    ],
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
                'type' => SectionTypes::INDUSTRIES,
                'sort_order' => 5,
                'is_visible' => true,
                'nav_label' => 'Industries',
                'anchor' => 'industries',
                'content' => [
                    'eyebrow' => 'Industries',
                    'heading' => 'Four sectors, one dependable process',
                    'subheading' => 'Proven expertise across residential, commercial, industrial, and infrastructure developments.',
                    'show_project_count' => true,
                    'view_all_label' => 'Explore industries →',
                    'buttons' => [
                        ['label' => 'Explore industries', 'link_type' => 'url', 'target' => null, 'url' => '/industries', 'style' => 'secondary'],
                    ],
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
                'sort_order' => 6,
                'is_visible' => true,
                'nav_label' => 'Projects',
                'anchor' => 'projects',
                'content' => [
                    'eyebrow' => 'Featured projects',
                    'heading' => 'Selected work that speaks for itself',
                    'subheading' => 'Explore builds completed on time, within budget, and to exacting specifications.',
                    'featured_count' => 4,
                    'show_filter_tabs' => true,
                    'view_all_label' => 'All projects →',
                    'buttons' => [
                        ['label' => 'View all projects', 'link_type' => 'url', 'target' => null, 'url' => '/projects', 'style' => 'primary'],
                    ],
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
                'sort_order' => 7,
                'is_visible' => true,
                'nav_label' => 'Reviews',
                'anchor' => 'testimonials',
                'content' => [
                    'eyebrow' => 'Client feedback',
                    'heading' => 'Trusted by developers, homeowners, and public leaders',
                    'subheading' => 'What our clients say about project communication, speed, and finish quality.',
                    'layout' => 'carousel',
                    'show_rating_stars' => true,
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
                'sort_order' => 8,
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
                'key' => 'faq',
                'type' => SectionTypes::FAQ,
                'sort_order' => 9,
                'is_visible' => true,
                'nav_label' => 'FAQ',
                'anchor' => 'faq',
                'content' => [
                    'eyebrow' => 'Frequently Asked Questions',
                    'heading' => 'Everything you need to know about building with Tnila',
                    'subheading' => 'Clear answers on project estimations, permits, warranties, and construction timelines.',
                    'show_contact_card' => true,
                    'contact_card_text' => 'Still have questions? Our engineering desk is here to help.',
                    'buttons' => [
                        ['label' => 'Ask a Question', 'link_type' => 'url', 'target' => null, 'url' => '/contact', 'style' => 'primary'],
                    ],
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'dark',
                    'vertical_padding' => 'm',
                ],
            ],
            [
                'key' => 'blog',
                'type' => SectionTypes::BLOG,
                'sort_order' => 10,
                'is_visible' => true,
                'nav_label' => 'Insights',
                'anchor' => 'blog',
                'content' => [
                    'eyebrow' => 'From the blog',
                    'heading' => 'Recent thinking, tips, and project updates',
                    'subheading' => 'Insights from the field on construction methods, scheduling, and engineering.',
                    'articles_count' => 3,
                    'view_all_label' => 'Read all posts →',
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
                'sort_order' => 11,
                'is_visible' => true,
                'nav_label' => 'Contact',
                'anchor' => 'contact',
                'content' => [
                    'eyebrow' => 'Contact',
                    'heading' => 'Start a conversation about your next project',
                    'subheading' => 'Whether you need a quote, a follow-up on a service, or a discussion about an upcoming build, we’d love to hear from you.',
                    'show_map' => true,
                    'show_direct_cards' => true,
                    'submit_button_label' => 'Send message',
                    'confirmation_message' => 'Thank you for reaching out. We will get back to you within 24 hours.',
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
