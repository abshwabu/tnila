@php
    use App\Support\Site;

    $settings = Site::settings();
    $branding = $settings->branding ?? [];
    $navigation = $settings->navigation ?? [];

    $siteName = $branding['site_name'] ?? config('app.name', 'Tnila');
    $tagline = $branding['tagline'] ?? 'Construction Company';
    $logoLight = filled($branding['logo_light'] ?? null) ? Site::imageUrl($branding['logo_light']) : null;

    $defaultLinks = [
        ['label' => 'Home', 'href' => route('home'), 'match' => 'home'],
        ['label' => 'About', 'href' => route('about.index'), 'match' => 'about.*'],
        ['label' => 'Services', 'href' => route('services.index'), 'match' => 'services.*'],
        ['label' => 'Industries', 'href' => route('industries.index'), 'match' => 'industries.*'],
        ['label' => 'Projects', 'href' => route('projects.index'), 'match' => 'projects.*'],
        ['label' => 'Blog', 'href' => route('blog.index'), 'match' => 'blog.*'],
        ['label' => 'Careers', 'href' => route('careers.index'), 'match' => 'careers.*'],
        ['label' => 'FAQs', 'href' => route('faqs.index'), 'match' => 'faqs.*'],
    ];

    $navConfig = $navigation['items'] ?? $navigation;
    $menuLinks = [];

    if (is_array($navConfig) && ! empty($navConfig)) {
        foreach ($navConfig as $item) {
            if (! is_array($item) || empty($item['label'])) {
                continue;
            }

            $label = $item['label'];
            $type = $item['type'] ?? 'route';
            $openInNewTab = (bool) ($item['open_in_new_tab'] ?? false);

            if ($type === 'section' && filled($item['section_key'] ?? null)) {
                $anchor = Site::resolveSectionAnchor($item['section_key']);
                $href = request()->routeIs('home') ? '#' . $anchor : url('/#' . $anchor);
            } else {
                $href = $item['url'] ?? '/';
            }

            $menuLinks[] = [
                'label' => $label,
                'href' => $href,
                'new_tab' => $openInNewTab,
            ];
        }
    }

    if (empty($menuLinks)) {
        $menuLinks = array_map(fn ($l) => [
            'label' => $l['label'],
            'href' => $l['href'],
            'new_tab' => false,
            'match' => $l['match'],
        ], $defaultLinks);
    }

    $ctaLabel = $navigation['cta_label'] ?? 'Start a project';
    $ctaUrl = $navigation['cta_url'] ?? route('contact');
    $ctaNewTab = (bool) ($navigation['cta_open_in_new_tab'] ?? false);
@endphp

<header class="sticky top-0 z-50 border-b border-stone-200/80 bg-stone-50/80 backdrop-blur-2xl" x-data="{ open: false }" @keydown.escape.window="open = false">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            @if($logoLight)
                <img src="{{ $logoLight }}" alt="{{ $siteName }}" class="h-10 w-auto max-w-[200px] object-contain" />
            @else
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-sm font-black text-stone-50 shadow-sm shadow-slate-950/10">
                    {{ substr($siteName, 0, 1) }}
                </span>
                <div>
                    <p class="text-[0.7rem] font-semibold uppercase tracking-[0.35em] text-amber-700">{{ $siteName }}</p>
                    <p class="text-sm font-semibold tracking-tight text-slate-950">{{ $tagline }}</p>
                </div>
            @endif
        </a>

        <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 xl:flex">
            @foreach ($menuLinks as $link)
                <a
                    href="{{ $link['href'] }}"
                    @if(!empty($link['new_tab'])) target="_blank" rel="noopener noreferrer" @endif
                    class="transition duration-200 ease-out hover:text-slate-950 {{ request()->is(ltrim($link['href'], '/')) || (isset($link['match']) && request()->routeIs($link['match'])) ? 'text-slate-950 font-semibold' : '' }}"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-3 xl:flex">
            <x-button :href="$ctaUrl" :target="$ctaNewTab ? '_blank' : null" :rel="$ctaNewTab ? 'noopener noreferrer' : null">
                {{ $ctaLabel }}
            </x-button>
        </div>

        <button
            type="button"
            class="inline-flex items-center justify-center rounded-xl border border-stone-300 bg-white p-3 text-slate-700 transition duration-200 ease-out hover:border-slate-400 hover:bg-stone-100 xl:hidden"
            @click="open = !open"
            :aria-expanded="open"
            aria-controls="mobile-navigation"
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

    <div id="mobile-navigation" class="border-t border-stone-200 bg-stone-50 px-6 py-5 xl:hidden" x-show="open" x-cloak x-transition.opacity.duration.200ms>
        <div class="mx-auto grid max-w-7xl gap-4 text-sm font-medium text-slate-700">
            @foreach ($menuLinks as $link)
                <a
                    href="{{ $link['href'] }}"
                    @if(!empty($link['new_tab'])) target="_blank" rel="noopener noreferrer" @endif
                    class="card-surface px-4 py-3 text-slate-700 card-surface-hover"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
            <x-button :href="$ctaUrl" :target="$ctaNewTab ? '_blank' : null" class="w-full justify-center">
                {{ $ctaLabel }}
            </x-button>
        </div>
    </div>
</header>
