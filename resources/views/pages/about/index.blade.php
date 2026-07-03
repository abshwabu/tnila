@extends('layouts.public')

@section('title', 'About | Tnila')
@section('meta_description', 'Learn who Tnila is, how we work, and what drives our construction projects.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'About']]" />
            <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_0.9fr] lg:items-end">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">About Tnila</p>
                    <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">A construction partner built around clarity, quality, and delivery.</h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">We help clients shape projects that move smoothly from intent to completion, with a process designed to reduce friction and keep every stakeholder informed.</p>
                </div>
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">At a glance</p>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-stone-50 p-4">
                            <p class="text-sm text-slate-500">Focus</p>
                            <p class="mt-1 text-lg font-semibold text-slate-950">Construction delivery</p>
                        </div>
                        <div class="rounded-2xl bg-stone-50 p-4">
                            <p class="text-sm text-slate-500">Markets</p>
                            <p class="mt-1 text-lg font-semibold text-slate-950">4 core industries</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <a href="{{ route('about.story') }}" class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">Our story</p>
                    <h2 class="mt-3 text-2xl font-semibold text-slate-950">How Tnila started</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">The journey from a practical build team to a full-service construction company.</p>
                </a>
                <a href="{{ route('about.mission') }}" class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">Mission</p>
                    <h2 class="mt-3 text-2xl font-semibold text-slate-950">What guides us</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">A short statement of the values and standards behind every decision.</p>
                </a>
                <a href="{{ route('about.team') }}" class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-1">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">Team</p>
                    <h2 class="mt-3 text-2xl font-semibold text-slate-950">People who deliver</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Leadership profiles and roles that keep projects moving.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="px-6 py-8 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-cta-section primaryLabel="Contact us" secondaryLabel="View services" :secondaryHref="route('services.index')" />
        </div>
    </section>
@endsection
