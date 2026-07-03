@extends('layouts.public')

@section('title', 'Projects | Tnila')
@section('meta_description', 'Browse Tnila projects by industry and filter the portfolio by sector.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Projects']]" />
            <div class="mt-6 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Projects</p>
                <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">Work we are proud to stand behind.</h1>
                <p class="mt-6 text-lg leading-8 text-slate-600">Use the filter to browse by industry, or explore a specific project for more details about scope and delivery.</p>
            </div>

            <div class="mt-10">
                <livewire:project-filter :industry-slug="$selectedIndustrySlug" />
            </div>
        </div>
    </section>
@endsection
