@props([
    'service',
    'href' => null,
])

@php
    $href = $href ?? route('services.show', $service);
@endphp

<article class="group rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm transition duration-200 ease-out hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-950/5">
    <div class="flex items-start justify-between gap-4">
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-sm font-bold text-amber-800 ring-1 ring-amber-100">
            {{ \Illuminate\Support\Str::of($service->icon)->headline()->limit(1, '') ?: 'S' }}
        </div>
        <span class="rounded-full border border-stone-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Service</span>
    </div>

    <h3 class="mt-5 text-xl font-semibold text-slate-950">{{ $service->title }}</h3>
    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $service->short_description }}</p>

    <a href="{{ $href }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-900 transition duration-200 ease-out group-hover:text-amber-700">
        Learn more
        <span aria-hidden="true">→</span>
    </a>
</article>
