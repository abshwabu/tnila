@extends('layouts.public')

@section('title', 'Team | About | Tnila')
@section('meta_description', 'Meet the leadership team behind Tnila.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'About', 'url' => route('about.index')], ['label' => 'Team']]" />
            <div class="mt-6 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Team</p>
                <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">People who keep the work moving</h1>
                <p class="mt-6 text-lg leading-8 text-slate-600">Tnila is organized around a small leadership group and a network of specialists who know how to deliver without unnecessary noise.</p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach ([
                    ['name' => 'Amina Njeri', 'role' => 'Managing Director', 'bio' => 'Leads strategy, client relationships, and business growth.'],
                    ['name' => 'Daniel Mwangi', 'role' => 'Project Director', 'bio' => 'Oversees schedules, delivery standards, and site coordination.'],
                    ['name' => 'Ruth Otieno', 'role' => 'Commercial Lead', 'bio' => 'Guides scope, pricing, and the client handoff process.'],
                ] as $member)
                    <article class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-950 text-xl font-semibold text-stone-50">{{ substr($member['name'], 0, 1) }}</div>
                        <h2 class="mt-5 text-xl font-semibold text-slate-950">{{ $member['name'] }}</h2>
                        <p class="mt-1 text-sm font-medium text-amber-700">{{ $member['role'] }}</p>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $member['bio'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
