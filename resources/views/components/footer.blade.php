@php
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
                <p class="text-[0.7rem] font-semibold uppercase tracking-[0.35em] text-amber-300">Tnila</p>
                <h2 class="mt-4 max-w-sm font-display text-3xl leading-tight text-stone-50">Building durable spaces with calm execution and clear communication.</h2>
                <p class="mt-4 max-w-md text-sm leading-6 text-stone-400">
                    We deliver residential, commercial, industrial, and infrastructure projects with the kind of process clients can trust.
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <a href="https://www.linkedin.com" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-stone-300 transition duration-200 ease-out hover:border-amber-400/40 hover:text-amber-200" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.15 1.45-2.15 2.95v5.66H9.33V9h3.42v1.56h.05c.48-.91 1.64-1.85 3.38-1.85 3.62 0 4.29 2.38 4.29 5.47v6.27zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.55V9h3.57v11.45z"/></svg>
                    </a>
                    <a href="https://www.instagram.com" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-stone-300 transition duration-200 ease-out hover:border-amber-400/40 hover:text-amber-200" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9a5.5 5.5 0 0 1-5.5 5.5h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2Zm0 2A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9a3.5 3.5 0 0 0 3.5-3.5v-9A3.5 3.5 0 0 0 16.5 4h-9ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm5.25-2.95a1.05 1.05 0 1 1 0 2.1 1.05 1.05 0 0 1 0-2.1Z"/></svg>
                    </a>
                    <a href="https://x.com" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-stone-300 transition duration-200 ease-out hover:border-amber-400/40 hover:text-amber-200" aria-label="X">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M18.9 2H22l-6.78 7.77L23 22h-6.6l-5.17-6.67L5.4 22H2.3l7.25-8.32L1 2h6.75l4.7 6.1L18.9 2Zm-1.16 18h1.72L7.82 3.87H5.97L17.74 20Z"/></svg>
                    </a>
                </div>
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
                <p><span class="font-semibold text-stone-200">Email:</span> info@tnila.test</p>
                <p><span class="font-semibold text-stone-200">Phone:</span> +254 700 000 000</p>
                <p><span class="font-semibold text-stone-200">Office:</span> Addis Ababa, Ethiopia</p>
            </div>
            <div class="space-y-2 md:text-right">
                <p><span class="font-semibold text-stone-200">Admin:</span> <a href="/admin" class="text-amber-300 transition duration-200 ease-out hover:text-amber-200">/admin</a></p>
                <p>&copy; {{ now()->year }} Tnila. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
