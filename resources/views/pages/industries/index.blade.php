@extends('layouts.public')

@section('title', 'Industries | Tnila')
@section('meta_description', 'See the sectors Tnila serves, including residential, commercial, industrial, and infrastructure construction.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Industries']]" />
            <div class="mt-6 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Industries</p>
                <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">The sectors where our process matters most.</h1>
                <p class="mt-6 text-lg leading-8 text-slate-600">Our delivery model is adapted to the realities of each industry, so every project gets the right level of coordination and detail.</p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($industries as $industry)
                    <a href="{{ route('industries.show', $industry) }}" class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm transition duration-200 ease-out hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-950/5">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">{{ $industry->projects_count }} projects</p>
                        <h2 class="mt-4 text-xl font-semibold text-slate-950">{{ $industry->name }}</h2>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $industry->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
