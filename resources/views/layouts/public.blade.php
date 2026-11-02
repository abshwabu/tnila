@php
    use App\Support\ColorHelper;
    use App\Support\Site;

    $settings = Site::settings();
    $branding = $settings->branding ?? [];
    $theme = $settings->theme ?? [];
    $contact = $settings->contact ?? [];
    $social = $settings->social ?? [];
    $navigation = $settings->navigation ?? [];
    $seo = $settings->seo ?? [];
    $footer = $settings->footer ?? [];

    $siteName = $branding['site_name'] ?? config('app.name', 'Tnila');
    $tagline = $branding['tagline'] ?? null;

    $primary = $theme['primary'] ?? '#d97706';
    $primaryHover = ColorHelper::adjustBrightness($primary, -12);
    $primaryText = ColorHelper::contrastTextColor($primary);
    $secondary = $theme['secondary'] ?? '#0f172a';
    $secondaryHover = ColorHelper::adjustBrightness($secondary, -12);
    $accent = $theme['accent'] ?? '#f59e0b';
    $background = $theme['background'] ?? '#fffcf7';
    $surface = $theme['surface'] ?? '#ffffff';
    $text = $theme['text'] ?? '#0f172a';
    $textMuted = ColorHelper::adjustBrightness($text, 35);
    $border = ColorHelper::adjustBrightness($background, -8);
    $radiusValue = ColorHelper::radiusValue($theme['corner_radius'] ?? 'soft');
    $headingFont = ($theme['heading_font'] ?? '') === 'custom' ? ($theme['heading_font_custom'] ?? 'Sora') : ($theme['heading_font'] ?? 'Sora');
    $bodyFont = ($theme['body_font'] ?? '') === 'custom' ? ($theme['body_font_custom'] ?? 'Inter') : ($theme['body_font'] ?? 'Inter');

    $googleFontsUrl = ColorHelper::googleFontsUrl($headingFont, $bodyFont);

    $defaultTitle = $seo['meta_title'] ?? ($siteName . ' | ' . ($tagline ?? 'Construction Company'));
    $defaultDescription = $seo['meta_description'] ?? 'Tnila delivers construction projects across residential, commercial, industrial, and infrastructure sectors.';
    $canonicalUrl = url()->current();
    $faviconUrl = filled($branding['favicon'] ?? null) ? Site::imageUrl($branding['favicon']) : asset('favicon.ico');
    $resolvedOgImage = filled($seo['og_image'] ?? null) ? Site::imageUrl($seo['og_image']) : null;
    $twitterHandle = $seo['twitter_handle'] ?? null;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $defaultTitle)</title>
    <meta name="description" content="@yield('meta_description', $defaultDescription)">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ $faviconUrl }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="@yield('title', $defaultTitle)">
    <meta property="og:description" content="@yield('meta_description', $defaultDescription)">
    <meta property="og:site_name" content="{{ $siteName }}">
    @if(filled($resolvedOgImage))
        <meta property="og:image" content="{{ $resolvedOgImage }}">
    @endif

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $defaultTitle)">
    <meta name="twitter:description" content="@yield('meta_description', $defaultDescription)">
    @if(filled($twitterHandle))
        <meta name="twitter:site" content="{{ $twitterHandle }}">
    @endif
    @if(filled($resolvedOgImage))
        <meta name="twitter:image" content="{{ $resolvedOgImage }}">
    @endif

    {{-- Dynamic Google Fonts --}}
    @if($googleFontsUrl)
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="{{ $googleFontsUrl }}" rel="stylesheet">
    @endif

    {{-- Dynamic Injected Theme CSS Variables --}}
    <style>
        :root {
            --color-primary: {{ $primary }};
            --color-primary-hover: {{ $primaryHover }};
            --color-primary-text: {{ $primaryText }};
            --color-secondary: {{ $secondary }};
            --color-secondary-hover: {{ $secondaryHover }};
            --color-accent: {{ $accent }};
            --color-background: {{ $background }};
            --color-surface: {{ $surface }};
            --color-text: {{ $text }};
            --color-text-muted: {{ $textMuted }};
            --color-border: {{ $border }};
            --site-radius: {{ $radiusValue }};
            --font-heading: '{{ $headingFont }}', 'Sora', sans-serif;
            --font-body: '{{ $bodyFont }}', 'Inter', sans-serif;
        }

        body {
            font-family: var(--font-body);
            color: var(--color-text);
        }

        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: var(--font-heading) !important;
        }

        .btn-base {
            border-radius: var(--site-radius) !important;
        }

        .btn-primary {
            background-color: var(--color-primary) !important;
            border-color: var(--color-primary) !important;
            color: var(--color-primary-text) !important;
        }

        .btn-primary:hover {
            background-color: var(--color-primary-hover) !important;
            border-color: var(--color-primary-hover) !important;
        }

        .card-surface {
            border-radius: var(--site-radius) !important;
        }
    </style>

    @stack('head')
    @stack('structured-data')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    {{-- Advanced Head Analytics & Tracking Snippet --}}
    @if(filled($seo['analytics_snippet'] ?? null))
        {!! $seo['analytics_snippet'] !!}
    @endif
</head>
<body class="min-h-screen font-sans antialiased" @if($background && strtolower($background) !== '#fffcf7') style="background-color: {{ $background }}; background-image: none;" @endif>
    <x-header />

    <main>
        @yield('content')
    </main>

    <x-footer />

    @livewireScripts
</body>
</html>
