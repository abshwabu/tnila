@props([
    'title' => null,
    'eyebrow' => null,
])

<section {{ $attributes->merge(['class' => 'rounded-3xl border border-stone-200 bg-white p-6 shadow-sm']) }}>
    @if ($eyebrow)
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-600">{{ $eyebrow }}</p>
    @endif

    @if ($title)
        <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $title }}</h3>
    @endif

    <div class="mt-4 text-sm leading-6 text-slate-600">
        {{ $slot }}
    </div>
</section>
