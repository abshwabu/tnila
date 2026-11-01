@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Why Tnila';
    $heading = $content['heading'] ?? 'Built for trust with straightforward updates, milestones, and documentation';
    $subheading = $content['subheading'] ?? 'Established teams delivering every phase with discipline, craftsmanship, and accountability.';
    $storyIntro = $content['story_intro'] ?? 'Tnila began with a simple idea: clients deserve construction partners who are as organized as they are capable.';
    $mission = $content['mission'] ?? 'To deliver residential, commercial, industrial, and infrastructure builds with disciplined craftsmanship, transparent scheduling, and zero guesswork.';
    $vision = $content['vision'] ?? 'To be the most trusted construction delivery firm in East Africa, setting benchmarks for structural integrity and client clarity.';
    $story = $content['story'] ?? null;
    $values = is_array($content['values'] ?? null) && ! empty($content['values'])
        ? $content['values']
        : [
            ['title' => 'Structural Integrity', 'text' => 'We adhere to the strictest engineering tolerances, quality testing, and safety protocols.'],
            ['title' => 'On-Schedule Delivery', 'text' => 'Rigorous milestone tracking keeps trades aligned and handovers on time.'],
            ['title' => 'Calm Communication', 'text' => 'Weekly progress photos, transparent cost accounting, and dedicated project managers.'],
        ];
    $buttons = is_array($content['buttons'] ?? null) ? $content['buttons'] : [];
    $images = is_array($content['images'] ?? null) ? $content['images'] : [];
@endphp

<x-section-wrapper :section="$section" anchor="about">
    <div class="reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        {{-- Section Heading --}}
        <div class="max-w-3xl">
            @if(filled($eyebrow))
                <p class="section-kicker">{{ $eyebrow }}</p>
            @endif
            <h2 class="section-title mt-2">{{ $heading }}</h2>
            @if(filled($subheading))
                <p class="section-copy mt-4 max-w-2xl">{{ $subheading }}</p>
            @endif
        </div>

        {{-- Mission & Vision or Story Intro --}}
        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            @if(filled($mission))
                <div class="rounded-[1.75rem] border border-stone-200/80 bg-white/80 p-8 shadow-sm backdrop-blur-sm">
                    <span class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">Mission</span>
                    <h3 class="mt-3 text-xl font-semibold text-slate-950">What guides every build</h3>
                    <p class="mt-3 text-base leading-7 text-slate-600">{{ $mission }}</p>
                </div>
            @endif

            @if(filled($vision))
                <div class="rounded-[1.75rem] border border-stone-200/80 bg-white/80 p-8 shadow-sm backdrop-blur-sm">
                    <span class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">Vision</span>
                    <h3 class="mt-3 text-xl font-semibold text-slate-950">Where we are headed</h3>
                    <p class="mt-3 text-base leading-7 text-slate-600">{{ $vision }}</p>
                </div>
            @endif
        </div>

        {{-- Core Values --}}
        @if(! empty($values))
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                @foreach($values as $val)
                    <div class="card-surface card-surface-hover p-6">
                        <span class="section-kicker">{{ $val['title'] ?? 'Core Value' }}</span>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $val['text'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Rich Story Body & Optional Photos --}}
        @if(filled($story) || ! empty($images))
            <div class="mt-10 grid gap-8 lg:grid-cols-12 items-center">
                @if(filled($story))
                    <div class="{{ ! empty($images) ? 'lg:col-span-7' : 'lg:col-span-12' }} prose prose-stone max-w-none text-slate-600 leading-relaxed">
                        {!! $story !!}
                    </div>
                @endif

                @if(! empty($images))
                    <div class="{{ filled($story) ? 'lg:col-span-5' : 'lg:col-span-12' }} grid grid-cols-2 gap-3">
                        @foreach(array_slice($images, 0, 4) as $img)
                            <div class="aspect-square overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
                                <img src="{{ Site::imageUrl($img) }}" alt="Tnila build team" class="h-full w-full object-cover hover:scale-105 transition duration-300" />
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        {{-- Custom Section Action Buttons --}}
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
