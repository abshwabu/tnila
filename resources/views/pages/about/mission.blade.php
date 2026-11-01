@php
    use App\Support\Site;

    $section = Site::section('about');
    $content = $section->content ?? [];
    $mission = $content['mission'] ?? 'Deliver construction projects with clarity and confidence.';
    $vision = $content['vision'] ?? 'Be the contractor people recommend because the experience feels steady, not stressful.';
    $values = is_array($content['values'] ?? null) && ! empty($content['values'])
        ? $content['values']
        : [
            ['title' => 'Quality', 'text' => 'We measure the outcome against the brief, the schedule, and the details that matter most on handover day.'],
            ['title' => 'Communication', 'text' => 'Clients should always know what is happening, why it matters, and what comes next.'],
            ['title' => 'Delivery', 'text' => 'A good plan only matters if the team can execute it safely, on time, and with care.'],
        ];
@endphp

@extends('layouts.public')

@section('title', 'Mission | About | ' . Site::setting('branding.site_name', 'Tnila'))
@section('meta_description', 'See the mission, vision, and values that guide ' . Site::setting('branding.site_name', 'Tnila') . '.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'About', 'url' => route('about.index')], ['label' => 'Mission']]" />
            <div class="mt-6 grid gap-6 lg:grid-cols-3">
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 sm:p-8 shadow-sm lg:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Mission</p>
                    <h1 class="mt-3 font-display text-3xl sm:text-4xl text-slate-950">{{ $mission }}</h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">We exist to make construction less chaotic for clients, teams, and communities by pairing practical workmanship with a disciplined project process.</p>
                </div>
                <div class="rounded-[1.75rem] border border-stone-200 bg-slate-950 p-6 sm:p-8 text-stone-50 shadow-sm flex flex-col justify-center">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">Vision</p>
                    <h2 class="mt-3 font-display text-xl sm:text-2xl text-stone-100 leading-snug">{{ $vision }}</h2>
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @foreach ($values as $val)
                    <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                        <h3 class="text-xl font-semibold text-slate-950">{{ $val['title'] ?? 'Value' }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $val['text'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
