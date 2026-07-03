@extends('layouts.public')

@section('title', 'Our Story | About | Tnila')
@section('meta_description', 'Read the story behind Tnila and how the company grew into a trusted construction partner.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <x-breadcrumbs :items="[['label' => 'About', 'url' => route('about.index')], ['label' => 'Our story']]" />
            <h1 class="mt-6 font-display text-5xl leading-tight text-slate-950">Our story</h1>
            <div class="prose prose-slate mt-8 max-w-none">
                <p>Tnila began with a simple idea: clients deserve construction partners who are as organized as they are capable. The business grew around that principle, combining practical site execution with a calm, transparent process.</p>
                <p>Over time, the team expanded from small, dependable projects into a portfolio spanning homes, workplaces, industrial sites, and public infrastructure. What stayed constant was the promise to keep communication clear and delivery disciplined.</p>
                <p>Today, Tnila pairs a public-facing website with a structured Filament admin panel, so the same sense of order is visible both to clients and the internal team.</p>
            </div>
        </div>
    </section>
@endsection
