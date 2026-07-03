@php
    $links = [
        ['label' => 'Home', 'href' => route('home')],
        ['label' => 'About', 'href' => route('about.index')],
        ['label' => 'Services', 'href' => route('services.index')],
        ['label' => 'Industries', 'href' => route('industries.index')],
        ['label' => 'Projects', 'href' => route('projects.index')],
        ['label' => 'Blog', 'href' => route('blog.index')],
        ['label' => 'Careers', 'href' => route('careers.index')],
        ['label' => 'FAQs', 'href' => route('faqs.index')],
    ];

    $active = fn (string $routeName): bool => request()->routeIs($routeName);
@endphp

<header class="sticky top-0 z-50 border-b border-stone-200/80 bg-stone-50/80 backdrop-blur-2xl">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8" x-data="{ open: false }">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-sm font-black text-stone-50 shadow-sm shadow-slate-950/10">T</span>
            <div>
                <p class="text-[0.7rem] font-semibold uppercase tracking-[0.35em] text-amber-700">Tnila</p>
                <p class="text-sm font-semibold tracking-tight text-slate-950">Construction Company</p>
            </div>
        </a>

        <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 xl:flex">
            @foreach ($links as $link)
                <a
                    href="{{ $link['href'] }}"
                    @class([
                        'transition duration-200 ease-out hover:text-slate-950',
                        'text-slate-950' => $active(match ($link['label']) {
                            'Home' => 'home',
                            'About' => 'about.*',
                            'Services' => 'services.*',
                            'Industries' => 'industries.*',
                            'Projects' => 'projects.*',
                            'Blog' => 'blog.*',
                            'Careers' => 'careers.*',
                            'FAQs' => 'faqs.*',
                        }),
                    ])
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-3 xl:flex">
            <x-button href="{{ route('contact') }}">Start a project</x-button>
            <a href="/admin" class="btn-base btn-secondary">Admin</a>
        </div>

        <button
            type="button"
            class="inline-flex items-center justify-center rounded-xl border border-stone-300 bg-white p-3 text-slate-700 transition duration-200 ease-out hover:border-slate-400 hover:bg-stone-100 xl:hidden"
            @click="open = !open"
            :aria-expanded="open.toString()"
            aria-label="Toggle menu"
        >
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 5.75A.75.75 0 013.75 5h12.5a.75.75 0 010 1.5H3.75A.75.75 0 013 5.75zm0 4.25a.75.75 0 01.75-.75h12.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10zm0 4.25a.75.75 0 01.75-.75h12.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
            </svg>
            <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.22 4.22a.75.75 0 011.06 0L10 8.94l4.72-4.72a.75.75 0 111.06 1.06L11.06 10l4.72 4.72a.75.75 0 11-1.06 1.06L10 11.06l-4.72 4.72a.75.75 0 11-1.06-1.06L8.94 10 4.22 5.28a.75.75 0 010-1.06z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="border-t border-stone-200 bg-stone-50 px-6 py-5 xl:hidden" x-show="open" x-cloak x-transition.opacity.duration.200ms>
        <div class="mx-auto grid max-w-7xl gap-4 text-sm font-medium text-slate-700">
            @foreach ($links as $link)
                <a href="{{ $link['href'] }}" class="card-surface px-4 py-3 text-slate-700 card-surface-hover">{{ $link['label'] }}</a>
            @endforeach
            <x-button href="{{ route('contact') }}">Start a project</x-button>
            <a href="/admin" class="btn-base btn-secondary justify-center">Admin</a>
        </div>
    </div>
</header>
