@php
    use App\Support\Site;

    $section = Site::section('faq');
    $content = $section->content ?? [];
    $eyebrow = $content['eyebrow'] ?? 'FAQs';
    $heading = $content['heading'] ?? 'Answers to the questions people ask most often.';
    $subheading = $content['subheading'] ?? ($content['intro'] ?? 'Use the category filter to narrow the list and expand each answer for more detail.');
@endphp

@extends('layouts.public')

@section('title', 'FAQs | ' . Site::setting('branding.site_name', 'Tnila'))
@section('meta_description', 'Browse frequently asked questions about ' . Site::setting('branding.site_name', 'Tnila') . ', our services, process, and project delivery.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'FAQs']]" />
            <div class="mt-6 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">{{ $eyebrow }}</p>
                <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">{{ $heading }}</h1>
                <p class="mt-6 text-lg leading-8 text-slate-600">{{ $subheading }}</p>
            </div>

            <div class="mt-10">
                <livewire:faq-accordion />
            </div>
        </div>
    </section>
@endsection
