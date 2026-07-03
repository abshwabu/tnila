@extends('layouts.public')

@section('title', $service->title . ' | Services | Tnila')
@section('meta_description', $service->short_description)

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Services', 'url' => route('services.index')], ['label' => $service->title]]" />

            <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_0.8fr] lg:items-start">
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Service</p>
                    <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">{{ $service->title }}</h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">{{ $service->short_description }}</p>
                    <div class="prose prose-slate mt-8 max-w-none">
                        {!! $service->description !!}
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-[1.75rem] border border-stone-200 bg-slate-950 p-6 text-stone-50 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">Need help?</p>
                        <p class="mt-3 font-display text-2xl">Let’s talk about your scope, timeline, and goals.</p>
                        <div class="mt-6">
                            <x-button href="{{ route('contact') }}">Start a project</x-button>
                        </div>
                    </div>
                    <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-950">Other services</h2>
                        <div class="mt-4 grid gap-3">
                            @foreach ($services as $otherService)
                                <a href="{{ route('services.show', $otherService) }}" class="rounded-2xl border border-stone-200 px-4 py-3 text-sm font-medium text-slate-700 transition hover:border-stone-300 hover:bg-stone-50">{{ $otherService->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Featured work</p>
                <h2 class="mt-3 font-display text-3xl text-slate-950">Projects connected to this kind of delivery</h2>
                <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($featuredProjects as $project)
                        <x-project-card :project="$project" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
