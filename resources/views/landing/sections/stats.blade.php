@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Track Record';
    $heading = $content['heading'] ?? 'Dependable construction by the numbers';
    $subheading = $content['subheading'] ?? ($content['intro'] ?? 'A track record of dependable construction across East Africa.');
    $layout = $content['layout'] ?? 'grid_4';
    $counters = is_array($content['counters'] ?? null) && ! empty($content['counters'])
        ? $content['counters']
        : [
            ['value' => '12+', 'label' => 'Years Experience', 'subtext' => 'Delivering quality builds since 2014'],
            ['value' => '50+', 'label' => 'Delivered Projects', 'subtext' => 'Across 4 key sectors'],
            ['value' => '100%', 'label' => 'Safety Compliance', 'subtext' => 'Zero critical site incidents'],
            ['value' => '24h', 'label' => 'Client Response', 'subtext' => 'Dedicated site managers'],
        ];

    $gridCols = match($layout) {
        'grid_3' => 'md:grid-cols-3',
        'banner' => 'md:grid-cols-2 lg:grid-cols-4',
        default => 'sm:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<x-section-wrapper :section="$section" anchor="stats">
    <div class="reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        @if(filled($heading) || filled($eyebrow))
            <div class="mb-8 max-w-3xl">
                @if(filled($eyebrow))
                    <p class="section-kicker">{{ $eyebrow }}</p>
                @endif
                <h2 class="section-title mt-2">{{ $heading }}</h2>
                @if(filled($subheading))
                    <p class="section-copy mt-3 max-w-2xl">{{ $subheading }}</p>
                @endif
            </div>
        @endif

        <div class="grid gap-4 {{ $gridCols }}">
            @foreach($counters as $counter)
                <div class="rounded-2xl border border-stone-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <p class="font-display text-3xl sm:text-4xl font-bold tracking-tight text-slate-950">{{ $counter['value'] ?? '0' }}</p>
                    <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">{{ $counter['label'] ?? '' }}</p>
                    @if(filled($counter['subtext'] ?? null))
                        <p class="mt-1.5 text-xs text-slate-500 leading-relaxed">{{ $counter['subtext'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-section-wrapper>
