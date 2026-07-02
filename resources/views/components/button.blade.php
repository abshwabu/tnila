@props([
    'type' => 'button',
    'variant' => 'primary',
    'href' => null,
])

@php
    $classes = match ($variant) {
        'secondary' => 'bg-slate-900 text-white hover:bg-slate-800',
        'ghost' => 'bg-transparent text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-slate-100',
        default => 'bg-amber-500 text-slate-950 hover:bg-amber-400',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-full px-5 py-3 text-sm font-semibold transition ' . $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-full px-5 py-3 text-sm font-semibold transition ' . $classes]) }}>
        {{ $slot }}
    </button>
@endif
