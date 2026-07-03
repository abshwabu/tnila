@extends('layouts.public')

@section('title', $project->title . ' | Projects | Tnila')
@section('meta_description', strip_tags(\Illuminate\Support\Str::limit($project->description, 160)))

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[
                ['label' => 'Projects', 'url' => route('projects.index')],
                ['label' => $project->industry?->name, 'url' => route('industries.show', $project->industry)],
                ['label' => $project->title],
            ]" />

            <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_0.8fr] lg:items-start">
                <div class="overflow-hidden rounded-[2rem] border border-stone-200 bg-white shadow-sm">
                    <img src="{{ $project->featuredImageUrl() }}" alt="{{ $project->title }}" class="aspect-[16/10] w-full object-cover">
                    <div class="p-6 sm:p-8">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">{{ $project->industry?->name }}</p>
                        <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">{{ $project->title }}</h1>
                        <div class="mt-4 flex flex-wrap gap-3 text-sm font-semibold text-slate-500">
                            <span>{{ $project->location }}</span>
                            <span>•</span>
                            <span>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span>
                            <span>•</span>
                            <span>{{ $project->start_date?->format('M Y') }}</span>
                        </div>
                        <div class="prose prose-slate mt-8 max-w-none">
                            {!! $project->description !!}
                        </div>
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-[1.75rem] border border-stone-200 bg-slate-950 p-6 text-stone-50 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">Need a similar result?</p>
                        <p class="mt-3 font-display text-2xl">Let’s discuss your brief and how we can deliver it.</p>
                        <div class="mt-6">
                            <x-button href="{{ route('contact') }}">Contact us</x-button>
                        </div>
                    </div>

                    <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-950">Project details</h2>
                        <dl class="mt-5 space-y-4 text-sm">
                            <div class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                <dt class="text-slate-500">Industry</dt>
                                <dd class="font-medium text-slate-950">{{ $project->industry?->name }}</dd>
                            </div>
                            <div class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                <dt class="text-slate-500">Location</dt>
                                <dd class="font-medium text-slate-950">{{ $project->location }}</dd>
                            </div>
                            <div class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                                <dt class="text-slate-500">Status</dt>
                                <dd class="font-medium text-slate-950">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</dd>
                            </div>
                        </dl>
                    </div>
                </aside>
            </div>

            <div class="mt-12">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Related projects</p>
                <h2 class="mt-3 font-display text-3xl text-slate-950">More work in the same sector</h2>
                <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($relatedProjects as $relatedProject)
                        <x-project-card :project="$relatedProject" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
