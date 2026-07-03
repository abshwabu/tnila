@extends('layouts.public')

@section('title', 'Careers | Tnila')
@section('meta_description', 'Explore open roles at Tnila and apply for current job openings.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Careers']]" />
            <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_0.8fr] lg:items-end">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Careers</p>
                    <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">Join a team that values structure, craft, and ownership.</h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">We’re looking for people who care about delivery and want to help build a dependable construction brand.</p>
                </div>
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                    <h2 class="text-2xl font-semibold text-slate-950">Why people join</h2>
                    <ul class="mt-4 grid gap-3 text-sm leading-6 text-slate-600">
                        <li>Clear expectations and defined ownership</li>
                        <li>Meaningful project exposure</li>
                        <li>A team that cares about process as much as output</li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 grid gap-6">
                @forelse ($jobs as $job)
                    <a href="{{ route('careers.show', $job) }}" class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm transition duration-200 ease-out hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-950/5">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">{{ $job->department }}</p>
                                <h2 class="mt-3 text-2xl font-semibold text-slate-950">{{ $job->title }}</h2>
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 150) }}</p>
                            </div>
                            <div class="rounded-full border border-stone-200 px-4 py-2 text-sm font-semibold text-slate-700">{{ $job->location }} · {{ ucwords(str_replace('_', ' ', $job->employment_type)) }}</div>
                        </div>
                    </a>
                @empty
                    <div class="rounded-[1.75rem] border border-dashed border-stone-300 bg-white p-8 text-sm text-slate-600">No open roles right now.</div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
