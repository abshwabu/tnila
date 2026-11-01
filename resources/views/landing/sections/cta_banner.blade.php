@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $badge = $content['badge'] ?? ($content['eyebrow'] ?? "Let's build");
    $heading = $content['heading'] ?? 'Ready to start your project?';
    $subheading = $content['subheading'] ?? 'Tell us what you are planning and we will help shape the next step.';
    $primaryLabel = $content['primary_label'] ?? 'Get a quote';
    $primaryUrl = $content['primary_url'] ?? route('contact');
    $secondaryLabel = $content['secondary_label'] ?? 'Start your project';
    $secondaryUrl = $content['secondary_url'] ?? route('services.index');
@endphp

<x-section-wrapper :section="$section" anchor="start">
    <div class="reveal relative overflow-hidden rounded-[2rem] border border-stone-800 bg-slate-950 px-6 py-12 text-stone-50 shadow-xl sm:px-10 sm:py-16 opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(251,191,36,0.18),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.06),transparent_30%)]" aria-hidden="true"></div>
        <div class="relative grid gap-8 lg:grid-cols-[1.1fr_auto] lg:items-center">
            <div>
                @if(filled($badge))
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">{{ $badge }}</p>
                @endif
                <h2 class="mt-3 font-display text-3xl leading-tight text-white sm:text-4xl lg:text-5xl">{{ $heading }}</h2>
                @if(filled($subheading))
                    <p class="mt-4 max-w-2xl text-base leading-7 text-stone-300">{{ $subheading }}</p>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-3">
                @if(filled($primaryLabel))
                    <x-button :href="$primaryUrl">
                        {{ $primaryLabel }}
                    </x-button>
                @endif

                @if(filled($secondaryLabel))
                    <x-button :href="$secondaryUrl" variant="ghost" class="border-stone-700 text-stone-50 hover:bg-white/10">
                        {{ $secondaryLabel }}
                    </x-button>
                @endif
            </div>
        </div>
    </div>
</x-section-wrapper>
