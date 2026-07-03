@props([
    'items' => [],
])

<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'text-sm']) }}>
    <ol class="flex flex-wrap items-center gap-2 text-slate-500">
        <li>
            <a href="{{ route('home') }}" class="transition duration-200 ease-out hover:text-slate-900">Home</a>
        </li>

        @foreach ($items as $item)
            <li class="flex items-center gap-2">
                <span class="text-slate-300">/</span>
                @if (!empty($item['url']))
                    <a href="{{ $item['url'] }}" class="transition duration-200 ease-out hover:text-slate-900">{{ $item['label'] }}</a>
                @else
                    <span class="font-medium text-slate-900">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
