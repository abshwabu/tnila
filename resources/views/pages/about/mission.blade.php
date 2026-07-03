@extends('layouts.public')

@section('title', 'Mission | About | Tnila')
@section('meta_description', 'See the mission, vision, and values that guide Tnila.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'About', 'url' => route('about.index')], ['label' => 'Mission']]" />
            <div class="mt-6 grid gap-6 lg:grid-cols-3">
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm lg:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Mission</p>
                    <h1 class="mt-3 font-display text-4xl text-slate-950">Deliver construction projects with clarity and confidence.</h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">We exist to make construction less chaotic for clients, teams, and communities by pairing practical workmanship with a disciplined project process.</p>
                </div>
                <div class="rounded-[1.75rem] border border-stone-200 bg-slate-950 p-6 text-stone-50 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">Vision</p>
                    <h2 class="mt-3 font-display text-2xl">Be the contractor people recommend because the experience feels steady, not stressful.</h2>
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-slate-950">Quality</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">We measure the outcome against the brief, the schedule, and the details that matter most on handover day.</p>
                </div>
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-slate-950">Communication</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Clients should always know what is happening, why it matters, and what comes next.</p>
                </div>
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-slate-950">Delivery</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">A good plan only matters if the team can execute it safely, on time, and with care.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
