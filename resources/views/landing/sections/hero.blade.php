@props([
    'section' => null,
    'settings' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Construction, handled with care';
    $heading = $content['heading'] ?? $content['headline'] ?? 'Build with a team that keeps the process calm, clear, and on schedule.';
    $subheading = $content['subheading'] ?? $content['subheadline'] ?? 'From residential homes to industrial works, we help clients shape projects that feel well planned from the first conversation to handover.';
    $buttons = is_array($content['buttons'] ?? null) && ! empty($content['buttons'])
        ? $content['buttons']
        : [
            ['label' => 'Get a quote', 'link_type' => 'url', 'url' => route('contact'), 'style' => 'primary'],
            ['label' => 'View projects', 'link_type' => 'url', 'url' => route('projects.index'), 'style' => 'ghost'],
        ];
    $statChips = is_array($content['stat_chips'] ?? null) ? $content['stat_chips'] : [];
    $collageImages = is_array($content['collage_images'] ?? null) ? $content['collage_images'] : [];
    $bgImage = filled($content['background_image'] ?? null) ? Site::imageUrl($content['background_image']) : null;
@endphp

<x-section-wrapper :section="$section" anchor="hero" class="pt-14 lg:pt-20">
    <div class="absolute inset-x-0 top-0 -z-10 h-[44rem] bg-[radial-gradient(circle_at_top_left,rgba(251,191,36,0.16),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(15,23,42,0.08),transparent_30%),linear-gradient(180deg,rgba(255,252,247,0.98),rgba(255,251,247,0.62))] pointer-events-none" aria-hidden="true"></div>
    <div class="reveal grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        <div class="max-w-3xl">
            @if(filled($eyebrow))
                <p class="section-kicker">{{ $eyebrow }}</p>
            @endif

            <h1 class="mt-4 text-5xl leading-[1.02] sm:text-6xl lg:text-7xl">
                {{ $heading }}
            </h1>

            @if(filled($subheading))
                <p class="section-copy max-w-2xl">
                    {{ $subheading }}
                </p>
            @endif

            @if(! empty($buttons))
                <div class="mt-8 flex flex-wrap gap-3">
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

            <div class="mt-8 flex flex-wrap gap-3 text-sm text-slate-600">
                <span class="rounded-full border border-stone-200 bg-white px-4 py-2 shadow-sm">Residential</span>
                <span class="rounded-full border border-stone-200 bg-white px-4 py-2 shadow-sm">Commercial</span>
                <span class="rounded-full border border-stone-200 bg-white px-4 py-2 shadow-sm">Industrial</span>
                <span class="rounded-full border border-stone-200 bg-white px-4 py-2 shadow-sm">Infrastructure</span>
            </div>
        </div>

        <div class="grid gap-4">
            @if(! empty($collageImages))
                <div class="grid grid-cols-2 gap-3">
                    @foreach (array_slice($collageImages, 0, 4) as $img)
                        <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm aspect-square">
                            <img src="{{ Site::imageUrl($img) }}" alt="Construction work" class="h-full w-full object-cover hover:scale-105 transition duration-300" />
                        </div>
                    @endforeach
                </div>
            @else
                <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-white shadow-sm">
                    <div class="relative aspect-[4/5]">
                        <img
                            src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1600&q=80"
                            alt="Construction team reviewing plans on site"
                            class="h-full w-full object-cover"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/65 via-slate-950/10 to-transparent"></div>
                        <div class="absolute inset-x-5 bottom-5 flex items-end justify-between gap-4 text-white">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-200">Featured process</p>
                                <h2 class="mt-2 text-2xl font-semibold tracking-tight">A more organized way to build</h2>
                            </div>
                            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-md">
                                <p class="text-2xl font-bold">{{ \App\Models\Project::count() }}+</p>
                                <p class="mt-1 text-[0.7rem] uppercase tracking-[0.25em] text-stone-200">Projects delivered</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(! empty($statChips))
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 sm:gap-4">
                    @foreach ($statChips as $chip)
                        @if(filled($chip['value'] ?? null))
                            <div class="card-surface p-4 sm:p-5 shadow-sm">
                                <p class="text-2xl sm:text-3xl font-bold text-slate-950">{{ $chip['value'] }}</p>
                                <p class="mt-1 sm:mt-2 text-xs uppercase tracking-[0.2em] sm:tracking-[0.25em] text-slate-500">{{ $chip['label'] ?? '' }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 sm:gap-4">
                    <div class="rounded-2xl border border-stone-200 bg-slate-950 p-4 sm:p-5 text-stone-50 shadow-sm">
                        <p class="text-2xl sm:text-3xl font-bold">{{ \App\Models\Industry::count() }}</p>
                        <p class="mt-1 sm:mt-2 text-xs uppercase tracking-[0.2em] sm:tracking-[0.25em] text-stone-400">Industries</p>
                    </div>
                    <div class="rounded-2xl border border-stone-200 bg-white p-4 sm:p-5 shadow-sm">
                        <p class="text-2xl sm:text-3xl font-bold text-slate-950">{{ \App\Models\Service::count() }}</p>
                        <p class="mt-1 sm:mt-2 text-xs uppercase tracking-[0.2em] sm:tracking-[0.25em] text-slate-500">Services</p>
                    </div>
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 sm:p-5 shadow-sm">
                        <p class="text-2xl sm:text-3xl font-bold text-amber-900">24h</p>
                        <p class="mt-1 sm:mt-2 text-xs uppercase tracking-[0.2em] sm:tracking-[0.25em] text-amber-700">Response</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-section-wrapper>
