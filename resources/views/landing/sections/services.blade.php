@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Services';
    $heading = $content['heading'] ?? 'What we do best';
    $subheading = $content['subheading'] ?? 'Comprehensive construction capabilities delivered with discipline and craftsmanship.';
    $layout = $content['layout'] ?? 'grid_3';
    $maxItems = (int) ($content['max_items'] ?? 6);
    $viewAllLabel = $content['view_all_label'] ?? 'View all services →';
    $buttons = is_array($content['buttons'] ?? null) ? $content['buttons'] : [];

    $services = $items['services'] ?? \App\Models\Service::query()->orderBy('order')->get();
    $displayServices = $services->take($maxItems > 0 ? $maxItems : 6);

    $gridCols = match($layout) {
        'grid_2' => 'md:grid-cols-2',
        default => 'md:grid-cols-2 xl:grid-cols-3',
    };
@endphp

<x-section-wrapper :section="$section" anchor="services">
    <div class="reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-2xl">
                @if(filled($eyebrow))
                    <p class="section-kicker">{{ $eyebrow }}</p>
                @endif
                <h2 class="section-title mt-2">{{ $heading }}</h2>
                @if(filled($subheading))
                    <p class="section-copy mt-3">{{ $subheading }}</p>
                @endif
            </div>

            @if(filled($viewAllLabel))
                <a href="{{ route('services.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">
                    {{ $viewAllLabel }}
                </a>
            @endif
        </div>

        <div class="mt-8 grid gap-6 {{ $gridCols }}">
            @foreach ($displayServices as $service)
                <x-service-card :service="$service" />
            @endforeach
        </div>

        @if(! empty($buttons))
            <div class="mt-10 flex flex-wrap gap-3">
                @foreach ($buttons as $btn)
                    @if(filled($btn['label'] ?? null))
                        @php
                            $btnUrl = ($btn['link_type'] ?? 'url') === 'section' && filled($btn['target'] ?? null)
                                ? '#' . $btn['target']
                                : ($btn['url'] ?? '#');
                            $btnVariant = match ($btn['style'] ?? 'primary') {
                                'secondary' => 'secondary',
                                'ghost' => 'ghost',
                                default => 'primary',
                            };
                        @endphp
                        <x-button :href="$btnUrl" :variant="$btnVariant">
                            {{ $btn['label'] }}
                        </x-button>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</x-section-wrapper>
