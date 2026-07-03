@extends('layouts.public')

@section('title', 'Services | Tnila')
@section('meta_description', 'Explore the construction services Tnila offers for residential, commercial, industrial, and infrastructure projects.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Services']]" />
            <div class="mt-6 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Services</p>
                <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">Construction services designed to reduce friction.</h1>
                <p class="mt-6 text-lg leading-8 text-slate-600">We support projects with practical delivery, strong communication, and a focus on the details that matter to clients and end users.</p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($services as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="px-6 py-8 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-cta-section secondaryLabel="View industries" :secondaryHref="route('industries.index')" />
        </div>
    </section>
@endsection
