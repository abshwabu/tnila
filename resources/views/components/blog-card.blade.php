@props([
    'post',
    'href' => null,
])

@php
    $href = $href ?? route('blog.show', $post);
@endphp

<article class="group overflow-hidden rounded-[1.75rem] border border-stone-200 bg-white shadow-sm transition duration-200 ease-out hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-950/5">
    <a href="{{ $href }}" class="block">
        <div class="relative aspect-[16/10] overflow-hidden bg-slate-900">
            @if ($post->cover_image)
                <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="h-full w-full object-cover opacity-90 transition duration-500 ease-out group-hover:scale-[1.03]" loading="lazy">
            @else
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(251,191,36,0.25),transparent_30%),linear-gradient(135deg,#0f172a,#1e293b_55%,#451a03)]"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between gap-3 text-white">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-200">{{ $post->category }}</p>
                    <p class="mt-2 text-lg font-semibold">{{ $post->title }}</p>
                </div>
                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white backdrop-blur">{{ optional($post->published_at)->format('M j, Y') }}</span>
            </div>
        </div>

        <div class="p-6">
            <p class="text-sm leading-6 text-slate-600">{{ $post->excerpt }}</p>
            <div class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-900 transition duration-200 ease-out group-hover:text-amber-700">
                Read article
                <span aria-hidden="true">→</span>
            </div>
        </div>
    </a>
</article>
