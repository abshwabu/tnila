@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Frequently Asked Questions';
    $heading = $content['heading'] ?? 'Everything you need to know about building with Tnela';
    $subheading = $content['subheading'] ?? ($content['intro'] ?? 'Clear answers on project estimations, permits, warranties, and construction timelines.');
    $showContactCard = (bool) ($content['show_contact_card'] ?? true);
    $contactCardText = $content['contact_card_text'] ?? 'Still have questions? Our engineering desk is here to help.';
    $buttons = is_array($content['buttons'] ?? null) ? $content['buttons'] : [];

    $faqs = ($items['faqs'] ?? \App\Models\Faq::query()->orderBy('order')->get())->take(6);
@endphp

<x-section-wrapper :section="$section" anchor="faq">
    <div class="reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        <div class="max-w-3xl">
            @if(filled($eyebrow))
                <p class="section-kicker">{{ $eyebrow }}</p>
            @endif
            <h2 class="section-title mt-2">{{ $heading }}</h2>
            @if(filled($subheading))
                <p class="section-copy mt-3 max-w-2xl">{{ $subheading }}</p>
            @endif
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-12 lg:items-start">
            <div class="{{ $showContactCard ? 'lg:col-span-8' : 'lg:col-span-12' }} space-y-4" x-data="{ activeAccordion: null }">
                @forelse ($faqs as $index => $faq)
                    <div class="overflow-hidden rounded-2xl border border-stone-200/90 bg-white shadow-sm transition duration-150">
                        <button
                            type="button"
                            @click="activeAccordion = (activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }})"
                            class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left font-semibold text-slate-900 transition hover:text-amber-700"
                        >
                            <span class="text-base sm:text-lg">{{ $faq->question }}</span>
                            <span
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-stone-200 text-sm font-bold text-slate-600 transition-transform duration-200"
                                :class="{ 'rotate-180 bg-amber-50 text-amber-800 border-amber-300': activeAccordion === {{ $faq->id }} }"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div
                            x-show="activeAccordion === {{ $faq->id }}"
                            x-collapse
                            x-cloak
                            class="px-6 pb-6 text-sm sm:text-base leading-relaxed text-slate-600"
                        >
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-stone-300 bg-stone-50 p-8 text-center text-sm text-slate-500">
                        No frequently asked questions available right now.
                    </div>
                @endforelse
            </div>

            @if($showContactCard)
                <div class="lg:col-span-4 rounded-[1.75rem] border border-stone-200/90 bg-white p-7 shadow-sm">
                    <span class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">Need Guidance?</span>
                    <h3 class="mt-3 text-xl font-semibold text-slate-950">Speak directly with an engineer</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $contactCardText }}</p>

                    <div class="mt-6 flex flex-col gap-3">
                        <x-button href="{{ route('contact') }}" class="w-full justify-center">
                            Ask a Question
                        </x-button>
                        <a href="{{ route('faqs.index') }}" class="inline-flex items-center justify-center text-xs font-semibold text-slate-600 hover:text-slate-950 transition">
                            Browse all FAQs →
                        </a>
                    </div>
                </div>
            @endif
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
