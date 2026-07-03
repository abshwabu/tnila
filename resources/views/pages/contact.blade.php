@extends('layouts.public')

@section('title', 'Contact | Tnila')
@section('meta_description', 'Contact Tnila to start a construction project or request a quote.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Contact']]" />
            <div class="mt-6 grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Contact</p>
                    <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">Start a conversation about your next project.</h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">Whether you need a quote, a follow-up on a service, or a discussion about an upcoming build, we’d love to hear from you.</p>

                    <div class="mt-8 grid gap-4">
                        <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5 shadow-sm">
                            <p class="text-sm font-semibold text-slate-950">Email</p>
                            <p class="mt-1 text-sm text-slate-600">info@tnila.test</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5 shadow-sm">
                            <p class="text-sm font-semibold text-slate-950">Phone</p>
                            <p class="mt-1 text-sm text-slate-600">+254 700 000 000</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5 shadow-sm">
                            <p class="text-sm font-semibold text-slate-950">Office</p>
                            <p class="mt-1 text-sm text-slate-600">Addis Ababa, Ethiopia</p>
                        </div>
                    </div>
                </div>

                <livewire:contact-form />
            </div>
        </div>
    </section>
@endsection
