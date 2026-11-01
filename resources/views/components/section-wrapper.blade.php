@props([
    'section' => null,
    'id' => null,
    'anchor' => null,
    'backgroundColor' => null,
    'backgroundImage' => null,
    'backgroundOverlay' => null,
    'textTheme' => null,
    'paddingSize' => null,
    'alignment' => null,
    'containerClass' => 'section-shell',
    'class' => '',
])

@php
    use App\Support\ColorHelper;
    use App\Support\Site;

    $style = is_array($section?->style) ? $section->style : [];
    $content = is_array($section?->content) ? $section->content : [];

    $resolvedAnchor = $anchor ?? $id ?? $section?->anchor ?? $section?->key;
    $resolvedBgColor = $backgroundColor ?? $style['background_color'] ?? null;
    $resolvedBgImage = $backgroundImage ?? $style['background_image'] ?? $content['background_image'] ?? null;
    $bgType = $style['background_type'] ?? 'none';
    if ($bgType === 'none' && filled($resolvedBgImage)) {
        $bgType = 'image';
    }

    $resolvedOverlay = $backgroundOverlay ?? $style['overlay_opacity'] ?? null;
    $resolvedGradient = $style['background_gradient'] ?? null;
    $resolvedTextTheme = $textTheme ?? $style['text_theme'] ?? null;
    $resolvedPadding = $paddingSize ?? $style['vertical_padding'] ?? 'm';
    $resolvedAlignment = $alignment ?? $style['alignment'] ?? 'left';

    $bgImageUrl = filled($resolvedBgImage) ? Site::imageUrl($resolvedBgImage) : null;

    $overlayOpacity = match ($resolvedOverlay) {
        'light' => 0.20,
        'medium' => 0.50,
        'dark' => 0.75,
        'heavy' => 0.90,
        default => ($bgType === 'image' ? 0.45 : 0.0),
    };

    // Auto-detect text theme if not forced
    if (empty($resolvedTextTheme)) {
        if ($bgType === 'image') {
            $resolvedTextTheme = 'dark';
        } elseif (filled($resolvedBgColor)) {
            $resolvedTextTheme = ColorHelper::isDark($resolvedBgColor) ? 'dark' : 'light';
        }
    }

    $isDarkTheme = ($resolvedTextTheme === 'dark');

    $paddingClasses = match (strtolower((string) $resolvedPadding)) {
        'none' => 'py-0',
        's', 'sm' => 'py-10 lg:py-14',
        'l', 'lg' => 'py-20 lg:py-28',
        'xl' => 'py-24 lg:py-36',
        default => 'py-16 lg:py-20', // m
    };

    $themeClasses = $isDarkTheme
        ? 'text-stone-50 [&_.section-title]:text-white [&_h1]:text-white [&_.section-copy]:text-stone-300 [&_.section-kicker]:text-amber-300'
        : 'text-slate-900 [&_.section-title]:text-slate-950 [&_.section-copy]:text-slate-600 [&_.section-kicker]:text-amber-700';

    $alignmentClasses = match ($resolvedAlignment) {
        'center' => 'text-center items-center justify-center',
        'right' => 'text-right items-end justify-end',
        default => 'text-left',
    };

    $styleAttribute = '';
    if ($bgType === 'color' && filled($resolvedBgColor)) {
        $styleAttribute .= "background-color: {$resolvedBgColor};";
    }
@endphp

<section
    @if(filled($resolvedAnchor)) id="{{ $resolvedAnchor }}" @endif
    {{ $attributes->merge(['class' => "relative overflow-hidden scroll-mt-20 page-section {$paddingClasses} {$themeClasses} {$class}"]) }}
    @if(filled($styleAttribute)) style="{{ $styleAttribute }}" @endif
>
    {{-- CSS Gradient if selected --}}
    @if($bgType === 'gradient' && filled($resolvedGradient))
        <div class="absolute inset-0 bg-gradient-to-br {{ $resolvedGradient }} pointer-events-none" aria-hidden="true"></div>
    @endif

    {{-- Background image layer if present --}}
    @if($bgType === 'image' && $bgImageUrl)
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none"
            style="background-image: url('{{ $bgImageUrl }}');"
            aria-hidden="true"
        ></div>
        @if($overlayOpacity > 0)
            <div
                class="absolute inset-0 bg-slate-950 pointer-events-none"
                style="opacity: {{ $overlayOpacity }};"
                aria-hidden="true"
            ></div>
        @endif
    @endif

    <div class="relative {{ $containerClass }} {{ $alignmentClasses }}">
        {{ $slot }}
    </div>
</section>
