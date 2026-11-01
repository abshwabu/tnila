<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Throwable;

class Site
{
    public const CACHE_SETTINGS_KEY = 'site:settings';

    public const CACHE_SECTIONS_KEY = 'site:sections';

    /**
     * Retrieve the singleton site settings, cached indefinitely.
     */
    public static function settings(): SiteSetting
    {
        try {
            $cached = Cache::get(self::CACHE_SETTINGS_KEY);

            if ($cached instanceof SiteSetting && ! ($cached instanceof \__PHP_Incomplete_Class)) {
                return $cached;
            }
        } catch (Throwable) {
            Cache::forget(self::CACHE_SETTINGS_KEY);
        }

        $settings = SiteSetting::current();

        try {
            Cache::forever(self::CACHE_SETTINGS_KEY, $settings);
        } catch (Throwable) {
            // Ignore cache storage failure
        }

        return $settings;
    }

    /**
     * Get a specific setting using dot-notation.
     */
    public static function setting(string $key, mixed $default = null): mixed
    {
        $settings = static::settings();

        return data_get($settings->toArray(), $key, $default);
    }

    /**
     * Retrieve all visible page sections ordered by sort_order, keyed by key.
     *
     * @return Collection<string, PageSection>
     */
    public static function sections(): Collection
    {
        try {
            $cached = Cache::get(self::CACHE_SECTIONS_KEY);

            if ($cached instanceof Collection && ! ($cached instanceof \__PHP_Incomplete_Class)) {
                return $cached;
            }
        } catch (Throwable) {
            Cache::forget(self::CACHE_SECTIONS_KEY);
        }

        try {
            $sections = PageSection::query()
                ->visible()
                ->ordered()
                ->get()
                ->keyBy('key');
        } catch (Throwable) {
            $sections = collect();
        }

        try {
            Cache::forever(self::CACHE_SECTIONS_KEY, $sections);
        } catch (Throwable) {
            // Ignore cache storage failure
        }

        return $sections;
    }

    /**
     * Retrieve a specific page section by its unique key with null-safe defaults.
     */
    public static function section(string $key): PageSection
    {
        $section = static::sections()->get($key);

        if ($section instanceof PageSection) {
            return $section;
        }

        return new PageSection([
            'key' => $key,
            'type' => $key,
            'sort_order' => 0,
            'is_visible' => true,
            'nav_label' => null,
            'anchor' => $key,
            'content' => [
                'eyebrow' => null,
                'heading' => null,
                'subheading' => null,
                'body' => null,
            ],
            'style' => [
                'background_type' => 'none',
                'background_color' => null,
                'text_theme' => 'dark',
                'vertical_padding' => 'm',
            ],
        ]);
    }

    /**
     * Flush all cached site settings and sections.
     */
    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_SETTINGS_KEY);
        Cache::forget(self::CACHE_SECTIONS_KEY);
    }

    /**
     * Resolve the preferred URL anchor identifier for a section.
     */
    public static function resolveSectionAnchor(string|PageSection|null $sectionOrKey): string
    {
        if ($sectionOrKey instanceof PageSection) {
            if (filled($sectionOrKey->anchor)) {
                return (string) $sectionOrKey->anchor;
            }
            $key = (string) $sectionOrKey->key;
        } else {
            $key = (string) $sectionOrKey;
        }

        if (blank($key)) {
            return '';
        }

        try {
            $section = static::sections()->get($key);
            if ($section instanceof PageSection && filled($section->anchor)) {
                return (string) $section->anchor;
            }
        } catch (Throwable) {
            // Ignore cache/lookup failure
        }

        return str_replace('_', '-', $key);
    }

    /**
     * Resolve a relative public storage path to a fully-qualified URL with null safety.
     */
    public static function imageUrl(?string $path, ?string $default = null): ?string
    {
        if (blank($path)) {
            return $default;
        }

        if (
            str_starts_with($path, 'http://') ||
            str_starts_with($path, 'https://') ||
            str_starts_with($path, '//') ||
            str_starts_with($path, 'data:')
        ) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}
