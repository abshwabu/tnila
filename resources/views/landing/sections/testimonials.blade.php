@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Client stories';
    $heading = $content['heading'] ?? 'What clients say about the work';
    $subheading = $content['subheading'] ?? null;
    $layout = $content['layout'] ?? 'carousel';
    $showRatingStars = (bool) ($content['show_rating_stars'] ?? true);
    $buttons = is_array($content['buttons'] ?? null) ? $content['buttons'] : [];

    $testimonials = $items['testimonials'] ?? \App\Models\Testimonial::query()->where('approved', true)->where('featured', true)->with(['customer', 'project'])->take(8)->get();
@endphp

<x-section-wrapper :section="$section" anchor="testimonials">
    <div class="reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        @if($layout === 'grid')
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div class="max-w-2xl">
                    @if(filled($eyebrow))
                        <p class="section-kicker">{{ $eyebrow }}</p>
                    @endif
                    <h2 class="section-title mt-2">{{ $heading }}</h2>
                    @if(filled($subheading))
                        <p class="section-copy mt-3">{{ $subheading }}</p>
                    @endif
                </div>

                <a href="{{ route('testimonials.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">
                    View all reviews →
                </a>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($testimonials as $testimonial)
                    <x-testimonial-card :testimonial="$testimonial" />
                @empty
                    <div class="col-span-full rounded-2xl border border-dashed border-stone-300 bg-stone-50 p-8 text-center text-sm text-slate-500">
                        No testimonials published yet.
                    </div>
                @endforelse
            </div>
        @else
            <livewire:testimonial-carousel :eyebrow="$eyebrow" :heading="$heading" />
        @endif

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
