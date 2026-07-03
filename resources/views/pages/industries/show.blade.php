@extends('layouts.public')

@section('title', $industry->name . ' | Industries | Tnila')
@section('meta_description', $industry->description)

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Industries', 'url' => route('industries.index')], ['label' => $industry->name]]" />
            <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_0.7fr] lg:items-center">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Industry</p>
                    <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">{{ $industry->name }}</h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">{{ $industry->description }}</p>
                </div>
                <div class="rounded-[1.75rem] border border-stone-200 bg-slate-950 p-6 text-stone-50 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">{{ $industry->projects_count }} projects</p>
                    <p class="mt-3 font-display text-2xl">Built for the delivery realities of {{ $industry->name }} work.</p>
                </div>
            </div>

            <div class="mt-12">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Projects</p>
                <h2 class="mt-3 font-display text-3xl text-slate-950">Recent work in this sector</h2>
                <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($projects as $project)
                        <x-project-card :project="$project" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
