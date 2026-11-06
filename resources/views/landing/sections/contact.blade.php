@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Contact';
    $heading = $content['heading'] ?? 'Start a conversation about your next project';
    $subheading = $content['subheading'] ?? 'Whether you need a quote, a follow-up on a service, or a discussion about an upcoming build, we’d love to hear from you.';
    $showMap = (bool) ($content['show_map'] ?? true);
    $showDirectCards = (bool) ($content['show_direct_cards'] ?? true);
    $buttons = is_array($content['buttons'] ?? null) ? $content['buttons'] : [];

    $contact = Site::setting('contact', []);
    $email = $contact['email'] ?? 'info@tnela.test';
    $phone = $contact['phone'] ?? '+254 700 000 000';
    $secondaryPhone = $contact['secondary_phone'] ?? null;
    $address = $contact['address'] ?? 'Addis Ababa, Ethiopia';
    $hours = $contact['working_hours'] ?? 'Mon - Fri: 8:00 AM - 5:00 PM';
    $mapEmbedUrl = $contact['map_embed_url'] ?? null;
@endphp

<x-section-wrapper :section="$section" anchor="contact">
    <div class="reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
            <div>
                @if(filled($eyebrow))
                    <p class="section-kicker">{{ $eyebrow }}</p>
                @endif
                <h2 class="section-title mt-2">{{ $heading }}</h2>
                @if(filled($subheading))
                    <p class="section-copy mt-3 max-w-xl">{{ $subheading }}</p>
                @endif

                @if($showDirectCards)
                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                        <div class="rounded-[1.5rem] border border-stone-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">Email us</p>
                            <p class="mt-1 text-sm font-semibold text-slate-950">{{ $email }}</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-stone-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">Call desk</p>
                            <p class="mt-1 text-sm font-semibold text-slate-950">{{ $phone }}</p>
                            @if(filled($secondaryPhone))
                                <p class="mt-0.5 text-xs text-slate-500">Alt: {{ $secondaryPhone }}</p>
                            @endif
                        </div>
                        <div class="rounded-[1.5rem] border border-stone-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">Headquarters</p>
                            <p class="mt-1 text-sm font-semibold text-slate-950">{{ $address }}</p>
                        </div>
                        @if(filled($hours))
                            <div class="rounded-[1.5rem] border border-stone-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">Working hours</p>
                                <p class="mt-1 text-sm font-semibold text-slate-950">{{ $hours }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                @if($showMap && filled($mapEmbedUrl))
                    <div class="mt-6 overflow-hidden rounded-[1.5rem] border border-stone-200 shadow-sm">
                        <iframe
                            src="{{ $mapEmbedUrl }}"
                            width="100%"
                            height="240"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Office Location Map"
                        ></iframe>
                    </div>
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
            </div>

            <div>
                <livewire:contact-form />
            </div>
        </div>
    </div>
</x-section-wrapper>
