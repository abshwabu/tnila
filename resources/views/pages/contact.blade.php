@php
    use App\Support\Site;

    $contact = Site::setting('contact', []);
    $email = $contact['email'] ?? 'info@tnela.test';
    $phone = $contact['phone'] ?? '+254 700 000 000';
    $secondaryPhone = $contact['secondary_phone'] ?? null;
    $address = $contact['address'] ?? 'Addis Ababa, Ethiopia';
    $hours = $contact['working_hours'] ?? 'Mon - Fri: 8:00 AM - 5:00 PM';
    $mapEmbedUrl = $contact['map_embed_url'] ?? null;

    $section = Site::section('contact');
    $content = $section->content ?? [];
    $eyebrow = $content['eyebrow'] ?? 'Contact';
    $heading = $content['heading'] ?? 'Start a conversation about your next project.';
    $subheading = $content['subheading'] ?? 'Whether you need a quote, a follow-up on a service, or a discussion about an upcoming build, we’d love to hear from you.';
@endphp

@extends('layouts.public')

@section('title', 'Contact | ' . Site::setting('branding.site_name', 'Tnela'))
@section('meta_description', 'Contact ' . Site::setting('branding.site_name', 'Tnela') . ' to start a construction project or request a quote.')

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumbs :items="[['label' => 'Contact']]" />
            <div class="mt-6 grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">{{ $eyebrow }}</p>
                    <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">{{ $heading }}</h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">{{ $subheading }}</p>

                    <div class="mt-8 grid gap-4">
                        <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5 shadow-sm">
                            <p class="text-sm font-semibold text-slate-950">Email</p>
                            <p class="mt-1 text-sm text-slate-600">{{ $email }}</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5 shadow-sm">
                            <p class="text-sm font-semibold text-slate-950">Phone</p>
                            <p class="mt-1 text-sm text-slate-600">{{ $phone }}</p>
                            @if(filled($secondaryPhone))
                                <p class="mt-0.5 text-xs text-slate-500">Alt: {{ $secondaryPhone }}</p>
                            @endif
                        </div>
                        <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5 shadow-sm">
                            <p class="text-sm font-semibold text-slate-950">Office</p>
                            <p class="mt-1 text-sm text-slate-600">{{ $address }}</p>
                        </div>
                        @if(filled($hours))
                            <div class="rounded-[1.5rem] border border-stone-200 bg-white p-5 shadow-sm">
                                <p class="text-sm font-semibold text-slate-950">Working Hours</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $hours }}</p>
                            </div>
                        @endif
                    </div>

                    @if(filled($mapEmbedUrl))
                        <div class="mt-6 overflow-hidden rounded-[1.5rem] border border-stone-200 shadow-sm">
                            <iframe
                                src="{{ $mapEmbedUrl }}"
                                width="100%"
                                height="260"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    @endif
                </div>

                <livewire:contact-form />
            </div>
        </div>
    </section>
@endsection
