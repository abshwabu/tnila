@props([
    'service',
    'href' => null,
])

@php
    $href = $href ?? route('services.show', $service);
@endphp

<article class="group card-surface card-surface-hover p-6">
    <div class="flex items-start justify-between gap-4">
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-sm font-bold text-amber-700 ring-1 ring-amber-100">
            {{ \Illuminate\Support\Str::of($service->title)->substr(0, 1)->upper() }}
        </div>
        <span class="rounded-full border border-stone-200 bg-stone-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Service</span>
    </div>

    <h3 class="mt-5 text-xl font-semibold text-slate-950">{{ $service->title }}</h3>
    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $service->short_description }}</p>

    <a href="{{ $href }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-900 transition duration-200 ease-out group-hover:text-amber-700">
        Learn more
        <span aria-hidden="true">→</span>
    </a>
</article>
