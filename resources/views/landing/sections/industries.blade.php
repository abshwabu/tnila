@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Industries';
    $heading = $content['heading'] ?? 'Four sectors, one dependable process';
    $subheading = $content['subheading'] ?? 'Proven expertise across residential, commercial, industrial, and infrastructure developments.';
    $showProjectCount = (bool) ($content['show_project_count'] ?? true);
    $viewAllLabel = $content['view_all_label'] ?? 'Explore industries →';
    $buttons = is_array($content['buttons'] ?? null) ? $content['buttons'] : [];

    $industries = $items['industries'] ?? \App\Models\Industry::query()->withCount('projects')->orderBy('name')->get();
@endphp

<x-section-wrapper :section="$section" anchor="industries">
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
                <a href="{{ route('industries.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">
                    {{ $viewAllLabel }}
                </a>
            @endif
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($industries as $industry)
                <a href="{{ route('industries.show', $industry) }}" class="card-surface card-surface-hover p-6">
                    @if($showProjectCount)
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">{{ $industry->projects_count }} projects</p>
                    @endif
                    <h3 class="mt-4 text-xl font-semibold text-slate-950">{{ $industry->name }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $industry->description }}</p>
                </a>
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
