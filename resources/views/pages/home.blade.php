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
    <section class="relative overflow-hidden px-6 pb-16 pt-14 lg:px-8 lg:pb-24">
        <div class="absolute inset-x-0 top-0 -z-10 h-[42rem] bg-[radial-gradient(circle_at_top_left,rgba(251,191,36,0.15),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(15,23,42,0.08),transparent_30%),linear-gradient(180deg,rgba(255,251,235,0.96),rgba(255,255,255,0.4))]"></div>
        <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Construction, handled with care</p>
                <h1 class="mt-4 font-display text-5xl leading-tight text-slate-950 sm:text-6xl">Build with a team that keeps the process calm, clear, and on schedule.</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">
                    From residential homes to industrial works, we help clients shape projects that feel well planned from the first conversation to handover.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <x-button href="{{ route('contact') }}">Get a quote</x-button>
                    <x-button href="{{ route('projects.index') }}" variant="ghost">View projects</x-button>
                </div>
            </div>

            <div class="grid gap-4">
                <div class="rounded-[2rem] border border-stone-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-700">Featured process</p>
                    <h2 class="mt-3 font-display text-2xl text-slate-950">A more organized way to build</h2>
                    <ul class="mt-5 grid gap-3 text-sm leading-6 text-slate-600">
                        <li>Clear scoping and milestone tracking</li>
                        <li>Responsive communication throughout delivery</li>
                        <li>Media-rich project documentation in Filament</li>
                    </ul>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="rounded-[1.5rem] border border-stone-200 bg-slate-950 p-5 text-stone-50">
                        <p class="text-3xl font-bold">{{ $projectCount }}+</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.25em] text-stone-400">Projects</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5">
                        <p class="text-3xl font-bold text-slate-950">{{ $industryCount }}</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.25em] text-slate-500">Industries</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-stone-200 bg-amber-50 p-5">
                        <p class="text-3xl font-bold text-amber-900">{{ $services->count() }}</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.25em] text-amber-700">Services</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 py-8 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-4 rounded-[2rem] border border-stone-200 bg-white p-6 text-sm text-slate-600 shadow-sm md:grid-cols-3">
            <div><span class="font-semibold text-slate-950">Established teams</span> delivering every phase with discipline.</div>
            <div><span class="font-semibold text-slate-950">Built for trust</span> with straightforward updates and documentation.</div>
            <div><span class="font-semibold text-slate-950">Focused sectors</span> across the four industries you serve most.</div>
        </div>
    </section>

    <section class="px-6 py-16 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Services</p>
                    <h2 class="mt-3 font-display text-3xl text-slate-950">What we do best</h2>
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

    <section class="px-6 py-16 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Industries</p>
                    <h2 class="mt-3 font-display text-3xl text-slate-950">Four sectors, one dependable process</h2>
                </div>
                <a href="{{ route('industries.index') }}" class="text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">Explore industries →</a>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($industries as $industry)
                    <a href="{{ route('industries.show', $industry) }}" class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm transition duration-200 ease-out hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-950/5">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">{{ $industry->projects_count }} projects</p>
                        <h3 class="mt-4 text-xl font-semibold text-slate-950">{{ $industry->name }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $industry->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="px-6 py-16 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Featured projects</p>
                    <h2 class="mt-3 font-display text-3xl text-slate-950">Selected work that speaks for itself</h2>
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

    <section class="px-6 py-16 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <livewire:testimonial-carousel />
        </div>
    </section>

    <section class="px-6 py-8 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-cta-section />
        </div>
    </section>

    <section class="px-6 py-16 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">From the blog</p>
                    <h2 class="mt-3 font-display text-3xl text-slate-950">Recent thinking, tips, and project updates</h2>
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
