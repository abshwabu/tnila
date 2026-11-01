@php
    use App\Support\Site;

    $siteName = Site::setting('branding.site_name', 'Tnila');
    $tagline = Site::setting('branding.tagline', 'Construction Company');
    $seoTitle = Site::setting('seo.meta_title', "{$siteName} | {$tagline}");
    $seoDescription = Site::setting('seo.meta_description', 'Tnila builds residential, commercial, industrial, and infrastructure projects with a modern, client-friendly process.');
    $contactPhone = Site::setting('contact.phone', '+254700000000');
    $contactAddress = Site::setting('contact.address', 'Addis Ababa, Ethiopia');
    $sections = $sections ?? Site::sections();
    $settings = $settings ?? Site::settings();
    $items = $items ?? Site::items();
@endphp

@extends('layouts.public')

@section('title', $seoTitle)
@section('meta_description', $seoDescription)

@push('structured-data')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    'name' => $siteName,
                    'url' => config('app.url'),
                    'logo' => filled(Site::setting('branding.favicon')) ? Site::imageUrl(Site::setting('branding.favicon')) : asset('favicon.ico'),
                    'sameAs' => array_values(array_filter(array_column(Site::setting('social', []), 'url'))),
                ],
                [
                    '@type' => 'LocalBusiness',
                    'name' => $siteName,
                    'url' => config('app.url'),
                    'telephone' => $contactPhone,
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => $contactAddress,
                        'addressLocality' => 'Addis Ababa',
                        'addressCountry' => 'ET',
                    ],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    @foreach ($sections as $section)
        @if ($section->is_visible && view()->exists("landing.sections.{$section->type}"))
            @include("landing.sections.{$section->type}", [
                'section' => $section,
                'settings' => $settings,
                'items' => $items,
            ])
            @if (! $loop->last)
                <div class="accent-rule" aria-hidden="true"></div>
            @endif
        @endif
    @endforeach
@endsection
