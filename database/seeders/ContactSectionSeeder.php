<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PageSection;
use App\Models\SiteSetting;
use App\Support\SectionTypes;
use App\Support\Site;
use Illuminate\Database\Seeder;

class ContactSectionSeeder extends Seeder
{
    /**
     * Seed only the contact section onto the home page at the bottom (above the footer),
     * without modifying or overwriting any other sections or application data.
     */
    public function run(): void
    {
        // Place at the bottom of currently visible sections (e.g. after blog)
        $maxVisibleOrder = (int) PageSection::query()
            ->where('is_visible', true)
            ->where('key', '!=', 'contact')
            ->max('sort_order');

        $targetSortOrder = $maxVisibleOrder > 0 ? $maxVisibleOrder + 1 : 9;

        // 1. Enable and configure ONLY the contact section
        PageSection::query()->updateOrCreate(
            ['key' => 'contact'],
            [
                'type' => SectionTypes::CONTACT,
                'sort_order' => $targetSortOrder,
                'is_visible' => true,
                'nav_label' => 'Contact',
                'anchor' => 'contact',
                'content' => [
                    'eyebrow' => 'Contact',
                    'heading' => 'Start a conversation about your next project',
                    'subheading' => 'Whether you need a quote, a follow-up on a service, or a discussion about an upcoming build, we’d love to hear from you.',
                    'show_map' => true,
                    'show_direct_cards' => true,
                    'map_embed_url' => 'https://share.google/q0xy2HOXpbX7FTXZL',
                    'submit_button_label' => 'Send message',
                    'confirmation_message' => 'Thank you for reaching out. We will get back to you within 24 hours.',
                ],
                'style' => [
                    'background_type' => 'none',
                    'background_color' => null,
                    'text_theme' => 'light',
                    'vertical_padding' => 'm',
                ],
            ]
        );

        // 2. Also ensure Site Settings has the Google Maps share link so the map works everywhere
        $siteSettings = SiteSetting::current();
        if ($siteSettings) {
            $contactData = is_array($siteSettings->contact) ? $siteSettings->contact : [];
            $contactData['map_embed_url'] = 'https://share.google/q0xy2HOXpbX7FTXZL';
            $siteSettings->update(['contact' => $contactData]);
        }

        // 3. Flush cache so frontend reflects changes immediately
        Site::flushCache();
    }
}
