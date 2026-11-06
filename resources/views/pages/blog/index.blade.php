@php
    use App\Support\Site;

    $section = Site::section('blog');
    $content = $section->content ?? [];
    $eyebrow = $content['eyebrow'] ?? 'Blog';
    $heading = $content['heading'] ?? 'Thoughts from the build side of the business.';
    $subheading = $content['subheading'] ?? 'Practical notes on construction, delivery, safety, and the decisions that shape a project’s outcome.';
@endphp

@extends('layouts.public')

@section('title', 'Blog | ' . Site::setting('branding.site_name', 'Tnela'))
@section('meta_description', 'Read the latest construction insights, project notes, and company updates from ' . Site::setting('branding.site_name', 'Tnela') . '.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Blog']]" />
            <div class="mt-6 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">{{ $eyebrow }}</p>
                <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">{{ $heading }}</h1>
                <p class="mt-6 text-lg leading-8 text-slate-600">{{ $subheading }}</p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($posts as $post)
                    <x-blog-card :post="$post" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
