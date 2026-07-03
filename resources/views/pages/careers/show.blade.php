@extends('layouts.public')

@section('title', $job->title . ' | Careers | Tnila')
@section('meta_description', strip_tags(\Illuminate\Support\Str::limit($job->description, 160)))

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Careers', 'url' => route('careers.index')], ['label' => $job->title]]" />

            <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_0.8fr] lg:items-start">
                <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">{{ $job->department }}</p>
                    <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">{{ $job->title }}</h1>
                    <div class="mt-4 flex flex-wrap gap-3 text-sm font-semibold text-slate-500">
                        <span>{{ $job->location }}</span>
                        <span>•</span>
                        <span>{{ ucwords(str_replace('_', ' ', $job->employment_type)) }}</span>
                    </div>
                    <div class="prose prose-slate mt-8 max-w-none">
                        {!! $job->description !!}
                    </div>
                    <h2 class="mt-10 text-2xl font-semibold text-slate-950">Requirements</h2>
                    <div class="prose prose-slate mt-4 max-w-none">
                        {!! $job->requirements !!}
                    </div>
                </div>

                <div class="space-y-6">
                    <livewire:job-application-form :job-listing="$job" />

                    <div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-950">Other open roles</h2>
                        <div class="mt-4 grid gap-3">
                            @foreach ($openJobs as $openJob)
                                <a href="{{ route('careers.show', $openJob) }}" class="rounded-2xl border border-stone-200 px-4 py-3 text-sm font-medium text-slate-700 transition hover:border-stone-300 hover:bg-stone-50">{{ $openJob->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
