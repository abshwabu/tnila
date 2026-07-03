@extends('layouts.public')

@section('title', 'FAQs | Tnila')
@section('meta_description', 'Browse frequently asked questions about Tnila, our services, process, and project delivery.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'FAQs']]" />
            <div class="mt-6 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">FAQs</p>
                <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">Answers to the questions people ask most often.</h1>
                <p class="mt-6 text-lg leading-8 text-slate-600">Use the category filter to narrow the list and expand each answer for more detail.</p>
            </div>

            <div class="mt-10">
                <livewire:faq-accordion />
            </div>
        </div>
    </section>
@endsection
