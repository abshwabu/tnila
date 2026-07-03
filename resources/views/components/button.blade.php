@props([
    'type' => 'button',
    'variant' => 'primary',
    'href' => null,
])

@php
    $classes = match ($variant) {
        'secondary' => 'border border-slate-900 bg-slate-900 text-stone-50 hover:border-slate-800 hover:bg-slate-800',
        'ghost' => 'border border-slate-300 bg-transparent text-slate-900 hover:border-slate-400 hover:bg-stone-100',
        default => 'border border-amber-500/40 bg-amber-500 text-slate-950 hover:border-amber-400 hover:bg-amber-400',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-semibold transition duration-200 ease-out ' . $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-semibold transition duration-200 ease-out ' . $classes]) }}>
        {{ $slot }}
    </button>
@endif
