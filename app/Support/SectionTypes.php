<?php

declare(strict_types=1);

namespace App\Support;

use App\Support\SectionTypes\AboutSectionType;
use App\Support\SectionTypes\BaseSectionType;
use App\Support\SectionTypes\BlogSectionType;
use App\Support\SectionTypes\ContactSectionType;
use App\Support\SectionTypes\CtaBannerSectionType;
use App\Support\SectionTypes\FaqSectionType;
use App\Support\SectionTypes\HeroSectionType;
use App\Support\SectionTypes\IndustriesSectionType;
use App\Support\SectionTypes\ProjectsSectionType;
use App\Support\SectionTypes\ServicesSectionType;
use App\Support\SectionTypes\StatsSectionType;
use App\Support\SectionTypes\TestimonialsSectionType;

class SectionTypes
{
    public const HERO = 'hero';
    public const ABOUT = 'about';
    public const SERVICES = 'services';
    public const INDUSTRIES = 'industries';
    public const PROJECTS = 'projects';
    public const TESTIMONIALS = 'testimonials';
    public const STATS = 'stats';
    public const CTA_BANNER = 'cta_banner';
    public const BLOG = 'blog';
    public const FAQ = 'faq';
    public const CONTACT = 'contact';

    /**
     * Map of all registered section type keys to their corresponding type handler class.
     *
     * @var array<string, class-string<BaseSectionType>>
     */
    protected static array $types = [
        self::HERO => HeroSectionType::class,
        self::ABOUT => AboutSectionType::class,
        self::SERVICES => ServicesSectionType::class,
        self::INDUSTRIES => IndustriesSectionType::class,
        self::PROJECTS => ProjectsSectionType::class,
        self::TESTIMONIALS => TestimonialsSectionType::class,
        self::STATS => StatsSectionType::class,
        self::CTA_BANNER => CtaBannerSectionType::class,
        self::BLOG => BlogSectionType::class,
        self::FAQ => FaqSectionType::class,
        self::CONTACT => ContactSectionType::class,
    ];

    /**
     * Get all registered section types.
     *
     * @return array<string, class-string<BaseSectionType>>
     */
    public static function all(): array
    {
        return static::$types;
    }

    /**
     * Get the handler class for a given section type key.
     *
     * @return class-string<BaseSectionType>|null
     */
    public static function get(string $key): ?string
    {
        return static::$types[$key] ?? null;
    }

    /**
     * Get associative array of [key => Label] for select dropdowns.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (static::$types as $key => $class) {
            $options[$key] = $class::getLabel();
        }

        return $options;
    }

    /**
     * Get human-readable label for a section type.
     */
    public static function label(string $key): string
    {
        $class = static::get($key);

        return $class ? $class::getLabel() : ucfirst(str_replace('_', ' ', $key));
    }

    /**
     * Get Heroicon name for a section type.
     */
    public static function icon(string $key): string
    {
        $class = static::get($key);

        return $class ? $class::getIcon() : 'heroicon-o-square-3-stack-3d';
    }

    /**
     * Retrieve the default content array for a given section type.
     *
     * @return array<string, mixed>
     */
    public static function defaultContent(string $key): array
    {
        $class = static::get($key);

        return $class ? $class::getDefaultContent() : [];
    }
}
