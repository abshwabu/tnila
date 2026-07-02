<x-layouts.app :title="'Tnila | Construction Company'">
    <x-header />

    <main>
        <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-amber-950 px-6 py-20 text-white lg:px-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(251,191,36,0.18),transparent_35%),radial-gradient(circle_at_bottom_left,rgba(148,163,184,0.15),transparent_30%)]"></div>
            <div class="relative mx-auto grid max-w-7xl gap-12 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                <div class="max-w-3xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-300">Construction, delivered cleanly</p>
                    <h1 class="mt-5 text-5xl font-black tracking-tight sm:text-6xl">A modern construction company website, built for trust and conversion.</h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                        Showcase projects, capture inquiries, and keep your team organized with a Laravel 11 stack built for long-term growth.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <x-button href="#contact">Request a quote</x-button>
                        <x-button href="#projects" variant="ghost">View projects</x-button>
                    </div>
                </div>

                <x-card eyebrow="Why this stack" title="Built for content, admin, and customer leads">
                    <ul class="grid gap-3 text-sm text-slate-600">
                        <li>Filament 3 admin at /admin</li>
                        <li>Livewire 3 inquiry form</li>
                        <li>Spatie Media Library for project images</li>
                        <li>SEO-friendly slugs for content models</li>
                    </ul>
                </x-card>
            </div>
        </section>

        <section class="mx-auto grid max-w-7xl gap-6 px-6 py-16 lg:grid-cols-3 lg:px-8">
            <x-card eyebrow="Fast delivery" title="Project management">
                Keep track of service offerings, completed builds, and new leads in one simple admin workflow.
            </x-card>
            <x-card eyebrow="Media ready" title="Image handling">
                Upload featured project photography through the media library and reuse it across the site.
            </x-card>
            <x-card eyebrow="SEO ready" title="Readable URLs">
                Services and projects use slug-based URLs to keep pages clean and search-friendly.
            </x-card>
        </section>

        <section id="services" class="mx-auto max-w-7xl px-6 py-8 lg:px-8">
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ([
                    ['title' => 'General contracting', 'body' => 'Reliable delivery for residential and commercial builds.'],
                    ['title' => 'Renovations', 'body' => 'Structured upgrades for interiors, exteriors, and expansions.'],
                    ['title' => 'Project management', 'body' => 'End-to-end oversight from planning to handover.'],
                ] as $service)
                    <x-card :title="$service['title']">
                        {{ $service['body'] }}
                    </x-card>
                @endforeach
            </div>
        </section>

        <section id="projects" class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-600">Selected work</p>
                    <h2 class="mt-2 text-3xl font-bold text-slate-900">Recent construction projects</h2>
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ([
                    ['name' => 'Oakridge Apartments', 'meta' => 'Residential | Nairobi'],
                    ['name' => 'Metro Logistics Hub', 'meta' => 'Commercial | Mombasa'],
                    ['name' => 'Horizon Villas', 'meta' => 'Luxury homes | Kiambu'],
                ] as $project)
                    <x-card :title="$project['name']" :eyebrow="$project['meta']">
                        Strong foundations, neat finishes, and a delivery process designed for clarity.
                    </x-card>
                @endforeach
            </div>
        </section>

        <section id="contact" class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-600">Contact</p>
                    <h2 class="mt-2 text-3xl font-bold text-slate-900">Start your next build.</h2>
                    <p class="mt-4 text-slate-600">Use the form to capture leads, then manage them from the Filament admin panel.</p>
                </div>

                <livewire:construction-inquiry-form />
            </div>
        </section>
    </main>

    <x-footer />
</x-layouts.app>
