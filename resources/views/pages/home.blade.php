@extends('layouts.public')

@section('title', 'Tnila | Construction Company')
@section('meta_description', 'Tnila builds residential, commercial, industrial, and infrastructure projects with a modern, client-friendly process.')

@push('structured-data')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    'name' => config('app.name', 'Tnila'),
                    'url' => config('app.url'),
                    'logo' => asset('favicon.ico'),
                    'sameAs' => [
                        'https://www.linkedin.com',
                        'https://www.instagram.com',
                        'https://x.com',
                    ],
                ],
                [
                    '@type' => 'LocalBusiness',
                    'name' => config('app.name', 'Tnila'),
                    'url' => config('app.url'),
                    'telephone' => '+254700000000',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'Nairobi',
                        'addressCountry' => 'KE',
                    ],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    <section class="page-section relative overflow-hidden pt-14 lg:pt-20">
        <div class="absolute inset-x-0 top-0 -z-10 h-[44rem] bg-[radial-gradient(circle_at_top_left,rgba(251,191,36,0.16),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(15,23,42,0.08),transparent_30%),linear-gradient(180deg,rgba(255,252,247,0.98),rgba(255,251,247,0.62))]"></div>
        <div class="section-shell reveal grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
            <div class="max-w-3xl">
                <p class="section-kicker">Construction, handled with care</p>
                <h1 class="mt-4 text-5xl leading-[1.02] text-slate-950 sm:text-6xl lg:text-7xl">
                    Build with a team that keeps the process calm, clear, and on schedule.
                </h1>
                <p class="section-copy max-w-2xl">
                    From residential homes to industrial works, we help clients shape projects that feel well planned from the first conversation to handover.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <x-button href="{{ route('contact') }}">Get a quote</x-button>
                    <x-button href="{{ route('projects.index') }}" variant="ghost">View projects</x-button>
                </div>
                <div class="mt-8 flex flex-wrap gap-3 text-sm text-slate-600">
                    <span class="rounded-full border border-stone-200 bg-white px-4 py-2 shadow-sm">Residential</span>
                    <span class="rounded-full border border-stone-200 bg-white px-4 py-2 shadow-sm">Commercial</span>
                    <span class="rounded-full border border-stone-200 bg-white px-4 py-2 shadow-sm">Industrial</span>
                    <span class="rounded-full border border-stone-200 bg-white px-4 py-2 shadow-sm">Infrastructure</span>
                </div>
            </div>

            <div class="grid gap-4">
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
                                <p class="text-2xl font-bold">{{ $projectCount }}+</p>
                                <p class="mt-1 text-[0.7rem] uppercase tracking-[0.25em] text-stone-200">Projects delivered</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-stone-200 bg-slate-950 p-5 text-stone-50 shadow-sm">
                        <p class="text-3xl font-bold">{{ $industryCount }}</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.25em] text-stone-400">Industries</p>
                    </div>
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
                        <p class="text-3xl font-bold text-slate-950">{{ $services->count() }}</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.25em] text-slate-500">Services</p>
                    </div>
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                        <p class="text-3xl font-bold text-amber-900">24h</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.25em] text-amber-700">Response</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell grid gap-4 md:grid-cols-3">
            <div class="card-surface card-surface-hover p-6">
                <span class="section-kicker">Delivery</span>
                <p class="mt-3 text-sm leading-6 text-slate-600">Established teams delivering every phase with discipline and accountability.</p>
            </div>
            <div class="card-surface card-surface-hover p-6">
                <span class="section-kicker">Clarity</span>
                <p class="mt-3 text-sm leading-6 text-slate-600">Built for trust with straightforward updates, milestones, and documentation.</p>
            </div>
            <div class="card-surface card-surface-hover p-6">
                <span class="section-kicker">Focus</span>
                <p class="mt-3 text-sm leading-6 text-slate-600">Focused sectors across residential, commercial, industrial, and infrastructure work.</p>
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="section-kicker">Services</p>
                    <h2 class="section-title">What we do best</h2>
                </div>
                <a href="{{ route('services.index') }}" class="text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">View all services →</a>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($services as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="section-kicker">Industries</p>
                    <h2 class="section-title">Four sectors, one dependable process</h2>
                </div>
                <a href="{{ route('industries.index') }}" class="text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">Explore industries →</a>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($industries as $industry)
                    <a href="{{ route('industries.show', $industry) }}" class="card-surface card-surface-hover p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">{{ $industry->projects_count }} projects</p>
                        <h3 class="mt-4 text-xl font-semibold text-slate-950">{{ $industry->name }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $industry->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="section-kicker">Featured projects</p>
                    <h2 class="section-title">Selected work that speaks for itself</h2>
                </div>
                <a href="{{ route('projects.index') }}" class="text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">All projects →</a>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($featuredProjects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
            <livewire:testimonial-carousel />
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell">
            <x-cta-section />
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="section-kicker">From the blog</p>
                    <h2 class="section-title">Recent thinking, tips, and project updates</h2>
                </div>
                <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">Read all posts →</a>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($recentPosts as $post)
                    <x-blog-card :post="$post" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
