@extends('layouts.public')

@section('title', 'Testimonials | Tnila')
@section('meta_description', 'Read client testimonials and feedback about working with Tnila.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Testimonials']]" />
            <div class="mt-6 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Testimonials</p>
                <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">What clients say after the project is delivered.</h1>
                <p class="mt-6 text-lg leading-8 text-slate-600">These are approved testimonials from clients and project stakeholders who have worked with the Tnila team.</p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($testimonials as $testimonial)
                    <x-testimonial-card :testimonial="$testimonial" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
