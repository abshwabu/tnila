<?php

declare(strict_types=1);

namespace App\Support;

class SectionTypes
{
    public const HERO = 'hero';
    public const ABOUT = 'about';
    public const SERVICES = 'services';
    public const PROJECTS = 'projects';
    public const TESTIMONIALS = 'testimonials';
    public const STATS = 'stats';
    public const BLOG = 'blog';
    public const FAQS = 'faqs';
    public const CONTACT = 'contact';
    public const CTA_BANNER = 'cta_banner';

    /**
     * Map of section types and human readable labels.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::HERO => 'Hero Banner',
            self::ABOUT => 'About / Story',
            self::SERVICES => 'Services Grid',
            self::PROJECTS => 'Featured Projects',
            self::TESTIMONIALS => 'Client Testimonials',
            self::STATS => 'Impact & Stats',
            self::BLOG => 'Recent News & Blog',
            self::FAQS => 'Frequently Asked Questions',
            self::CONTACT => 'Contact & Quote Inquiry',
            self::CTA_BANNER => 'Call to Action Banner',
        ];
    }

    /**
     * Get the label for a section type.
     */
    public static function label(string $type): string
    {
        return static::options()[$type] ?? ucfirst(str_replace('_', ' ', $type));
    }
}
