@props([
    'project',
    'href' => null,
])

@php
    $href = $href ?? route('projects.show', $project);
@endphp

<article class="group overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition duration-200 ease-out hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-950/5">
    <a href="{{ $href }}" class="block">
        <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
            <img
                src="{{ $project->featuredImageUrl() }}"
                alt="{{ $project->title }}"
                class="h-full w-full object-cover transition duration-500 ease-out group-hover:scale-[1.03]"
                loading="lazy"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/55 via-slate-950/10 to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between gap-3 text-white">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-200">{{ $project->industry?->name }}</p>
                    <p class="mt-2 text-lg font-semibold">{{ $project->title }}</p>
                </div>
                @if ($project->featured)
                    <span class="rounded-full bg-amber-400 px-3 py-1 text-xs font-semibold text-slate-950">Featured</span>
                @endif
            </div>
        </div>

        <div class="p-6">
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                <span>{{ $project->location }}</span>
                <span class="text-stone-300">•</span>
                <span>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span>
            </div>
            <p class="mt-4 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 125) }}</p>
            <div class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-900 transition duration-200 ease-out group-hover:text-amber-700">
                View project
                <span aria-hidden="true">→</span>
            </div>
        </div>
    </a>
</article>
