<?php

declare(strict_types=1);

use App\Support\Site;

if (! function_exists('site_setting')) {
    /**
     * Get a site setting by dot-notation key.
     */
    function site_setting(string $key, mixed $default = null): mixed
    {
        return Site::setting($key, $default);
    }
}

if (! function_exists('site_image')) {
    /**
     * Resolve an image path to a public storage URL with null-safety.
     */
    function site_image(?string $path, ?string $default = null): ?string
    {
        return Site::imageUrl($path, $default);
    }
}
