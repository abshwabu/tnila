@extends('layouts.public')

@section('title', 'Style Guide | Tnila')
@section('meta_description', 'Internal style guide for Tnila’s public-facing design system.')

@section('content')
    @php
        $sampleService = \App\Models\Service::query()->orderBy('order')->first();
        $sampleProject = \App\Models\Project::query()->with('industry')->first();
        $samplePost = \App\Models\BlogPost::query()->where('status', 'published')->whereNotNull('published_at')->first();
    @endphp

    <section class="page-section pt-14 lg:pt-20">
        <div class="section-shell">
            <x-breadcrumbs :items="[['label' => 'Style Guide']]" />

            <div class="mt-6 max-w-3xl">
                <p class="section-kicker">Internal reference</p>
                <h1 class="mt-3 text-5xl leading-tight text-slate-950 sm:text-6xl">A grounded, modern system for the public site.</h1>
                <p class="section-copy">This page documents the color palette, typography scale, controls, and card styles so the site keeps a consistent construction-tech feel as it grows.</p>
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell">
            <h2 class="section-title">Color palette</h2>
            <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                @foreach ([
                    ['name' => 'Charcoal', 'value' => '#0f172a', 'label' => 'Primary ink'],
                    ['name' => 'Surface', 'value' => '#fffcf7', 'label' => 'Page background'],
                    ['name' => 'Slate', 'value' => '#475569', 'label' => 'Secondary text'],
                    ['name' => 'Amber', 'value' => '#ea7f22', 'label' => 'Accent'],
                ] as $swatch)
                    <div class="card-surface overflow-hidden">
                        <div class="h-28" style="background: {{ $swatch['value'] }}"></div>
                        <div class="p-5">
                            <p class="text-sm font-semibold text-slate-950">{{ $swatch['name'] }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $swatch['value'] }}</p>
                            <p class="mt-3 text-xs uppercase tracking-[0.25em] text-slate-400">{{ $swatch['label'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <h2 class="section-title">Typography scale</h2>
                <p class="section-copy">Headings use Sora. Body copy uses Inter for maximum clarity on long-form pages and forms.</p>
            </div>
            <div class="grid gap-5 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Display 1</p>
                    <p class="mt-2 text-5xl leading-none text-slate-950">Build with confidence.</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Display 2</p>
                    <p class="mt-2 text-3xl leading-tight text-slate-950">Structured, current, and readable.</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Body</p>
                    <p class="mt-2 text-base leading-7 text-slate-600">Body copy stays relaxed and highly legible, with generous line height and a restrained neutral palette.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell">
            <h2 class="section-title">Buttons</h2>
            <div class="mt-8 flex flex-wrap gap-3">
                <x-button href="{{ route('contact') }}">Primary CTA</x-button>
                <x-button href="{{ route('services.index') }}" variant="ghost">Secondary CTA</x-button>
                <x-button href="{{ route('about.index') }}" variant="dark">Dark CTA</x-button>
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell">
            <h2 class="section-title">Cards</h2>
            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @if ($sampleService)
                    <x-service-card :service="$sampleService" />
                @else
                    <div class="card-surface p-6 text-slate-600">No service records available yet.</div>
                @endif

                @if ($sampleProject)
                    <x-project-card :project="$sampleProject" />
                @else
                    <div class="card-surface p-6 text-slate-600">No project records available yet.</div>
                @endif

                @if ($samplePost)
                    <x-blog-card :post="$samplePost" />
                @else
                    <div class="card-surface p-6 text-slate-600">No published blog posts available yet.</div>
                @endif
            </div>
        </div>
    </section>

    <div class="accent-rule"></div>

    <section class="page-section">
        <div class="section-shell" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true">
            <div class="reveal grid gap-6 rounded-[2rem] border border-stone-200 bg-white p-8 shadow-sm lg:grid-cols-[1fr_auto] lg:items-center" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
                <div>
                    <p class="section-kicker">Motion sample</p>
                    <h2 class="mt-3 text-3xl text-slate-950">Subtle scroll-triggered fade-in</h2>
                    <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-600">Sections should come in quickly and quietly, and respect reduced-motion settings automatically.</p>
                </div>
                <div class="rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 text-sm font-medium text-amber-900">
                    Alpine `x-intersect.once` + quick easing
                </div>
            </div>
        </div>
    </section>
@endsection
