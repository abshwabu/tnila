@php
    use App\Support\Site;

    $settings = Site::settings();
    $branding = $settings->branding ?? [];
    $contact = $settings->contact ?? [];
    $social = $settings->social ?? [];
    $footer = $settings->footer ?? [];

    $siteName = $branding['site_name'] ?? config('app.name', 'Tnila');
    $tagline = $branding['tagline'] ?? 'Construction Company';
    $footerLogo = filled($branding['footer_logo'] ?? null)
        ? Site::imageUrl($branding['footer_logo'])
        : (filled($branding['logo_dark'] ?? null) ? Site::imageUrl($branding['logo_dark']) : null);

    $aboutBlurb = $footer['about_blurb'] ?? 'Building durable spaces with calm execution and clear communication. We deliver residential, commercial, industrial, and infrastructure projects with the kind of process clients can trust.';

    $email = $contact['email'] ?? 'info@tnila.test';
    $phone = $contact['phone'] ?? '+254 700 000 000';
    $address = $contact['address'] ?? 'Addis Ababa, Ethiopia';

    $copyrightRaw = $footer['copyright_text'] ?? 'Tnila. All rights reserved.';
    $copyright = str_replace('{year}', (string) now()->year, $copyrightRaw);
    if (! str_starts_with($copyright, '©')) {
        $copyright = '© ' . now()->year . ' ' . $copyright;
    }

    $legalLinks = $footer['legal_links'] ?? [
        ['label' => 'Privacy Policy', 'url' => '#'],
        ['label' => 'Terms of Service', 'url' => '#'],
        ['label' => 'Safety & Compliance', 'url' => '#'],
    ];

    $groups = [
        'Company' => [
            ['label' => 'About', 'href' => route('about.index')],
            ['label' => 'Our story', 'href' => route('about.story')],
            ['label' => 'Mission', 'href' => route('about.mission')],
            ['label' => 'Team', 'href' => route('about.team')],
        ],
        'Services' => [
            ['label' => 'All services', 'href' => route('services.index')],
            ['label' => 'Industries', 'href' => route('industries.index')],
            ['label' => 'Projects', 'href' => route('projects.index')],
            ['label' => 'Testimonials', 'href' => route('testimonials.index')],
        ],
        'Resources' => [
            ['label' => 'Blog', 'href' => route('blog.index')],
            ['label' => 'Careers', 'href' => route('careers.index')],
            ['label' => 'FAQs', 'href' => route('faqs.index')],
            ['label' => 'Contact', 'href' => route('contact')],
        ],
    ];
@endphp

<footer class="border-t border-stone-200 bg-slate-950 px-6 py-16 text-stone-300 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="grid gap-12 lg:grid-cols-[1.15fr_1fr_1fr_1fr]">
            <div>
                @if($footerLogo)
                    <img src="{{ $footerLogo }}" alt="{{ $siteName }}" class="h-10 w-auto max-w-[200px] object-contain" />
                @else
                    <p class="text-[0.7rem] font-semibold uppercase tracking-[0.35em] text-amber-300">{{ $siteName }}</p>
                @endif
                <h2 class="mt-4 max-w-sm font-display text-3xl leading-tight text-stone-50">{{ $tagline }}</h2>
                <p class="mt-4 max-w-md text-sm leading-6 text-stone-400">
                    {{ $aboutBlurb }}
                </p>

                @if(! empty($social))
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        @foreach ($social as $item)
                            @if(is_array($item) && filled($item['url'] ?? null))
                                @php
                                    $platform = strtolower($item['platform'] ?? 'custom');
                                    $url = $item['url'];
                                @endphp
                                <a
                                    href="{{ $url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-stone-300 transition duration-200 ease-out hover:border-amber-400/40 hover:text-amber-200"
                                    aria-label="{{ ucfirst($platform) }}"
                                >
                                    @if($platform === 'linkedin')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.15 1.45-2.15 2.95v5.66H9.33V9h3.42v1.56h.05c.48-.91 1.64-1.85 3.38-1.85 3.62 0 4.29 2.38 4.29 5.47v6.27zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.55V9h3.57v11.45z"/></svg>
                                    @elseif($platform === 'instagram')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9a5.5 5.5 0 0 1-5.5 5.5h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2Zm0 2A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9a3.5 3.5 0 0 0 3.5-3.5v-9A3.5 3.5 0 0 0 16.5 4h-9ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm5.25-2.95a1.05 1.05 0 1 1 0 2.1 1.05 1.05 0 0 1 0-2.1Z"/></svg>
                                    @elseif($platform === 'x' || $platform === 'twitter')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M18.9 2H22l-6.78 7.77L23 22h-6.6l-5.17-6.67L5.4 22H2.3l7.25-8.32L1 2h6.75l4.7 6.1L18.9 2Zm-1.16 18h1.72L7.82 3.87H5.97L17.74 20Z"/></svg>
                                    @elseif($platform === 'facebook')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    @elseif($platform === 'youtube')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    @elseif($platform === 'telegram')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>
                                    @else
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            @foreach ($groups as $heading => $links)
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-stone-100">{{ $heading }}</p>
                    <ul class="mt-5 space-y-3 text-sm text-stone-400">
                        @foreach ($links as $link)
                            <li>
                                <a href="{{ $link['href'] }}" class="transition duration-200 ease-out hover:text-stone-100">{{ $link['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-12 grid gap-4 border-t border-white/10 pt-8 text-sm text-stone-400 md:grid-cols-2">
            <div class="space-y-2">
                <p><span class="font-semibold text-stone-200">Email:</span> {{ $email }}</p>
                <p><span class="font-semibold text-stone-200">Phone:</span> {{ $phone }}</p>
                <p><span class="font-semibold text-stone-200">Office:</span> {{ $address }}</p>
            </div>
            <div class="space-y-2 md:text-right">
                <p>{{ $copyright }}</p>
                @if(! empty($legalLinks))
                    <div class="flex flex-wrap gap-x-4 gap-y-1 md:justify-end text-xs text-stone-500 pt-1">
                        @foreach ($legalLinks as $legal)
                            @if(is_array($legal) && filled($legal['label'] ?? null))
                                <a href="{{ $legal['url'] ?? '#' }}" @if(!empty($legal['open_in_new_tab'])) target="_blank" rel="noopener noreferrer" @endif class="hover:text-stone-300 transition duration-150">
                                    {{ $legal['label'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</footer>
