@extends('layouts.public')

@section('title', $post->title . ' | Blog | Tnila')
@section('meta_description', $post->excerpt ?: strip_tags(\Illuminate\Support\Str::limit($post->content, 160)))

@push('structured-data')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->title,
            'description' => $post->excerpt ?: strip_tags(\Illuminate\Support\Str::limit($post->content, 160)),
            'author' => [
                '@type' => 'Person',
                'name' => $post->author_name,
            ],
            'datePublished' => optional($post->published_at)->toAtomString(),
            'mainEntityOfPage' => url()->current(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    <section class="px-6 py-14 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <x-breadcrumbs :items="[['label' => 'Blog', 'url' => route('blog.index')], ['label' => $post->title]]" />

            <div class="mt-6 overflow-hidden rounded-[2rem] border border-stone-200 bg-white shadow-sm">
                <div class="aspect-[16/8] bg-slate-900">
                    @if ($post->cover_image)
                        <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="h-full w-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1600&q=80" alt="{{ $post->title }}" class="h-full w-full object-cover">
                    @endif
                </div>
                <div class="p-6 sm:p-8">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">{{ $post->category }}</p>
                    <h1 class="mt-3 font-display text-5xl leading-tight text-slate-950">{{ $post->title }}</h1>
                    <div class="mt-4 flex flex-wrap gap-3 text-sm font-semibold text-slate-500">
                        <span>{{ $post->author_name }}</span>
                        <span>•</span>
                        <span>{{ optional($post->published_at)->format('M j, Y') }}</span>
                    </div>
                    <p class="mt-6 text-lg leading-8 text-slate-600">{{ $post->excerpt }}</p>
                </div>
            </div>

            <article class="prose prose-slate mt-10 max-w-none rounded-[2rem] border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
                {!! $post->content !!}
            </article>

            <div class="mt-12">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Related posts</p>
                <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($relatedPosts as $relatedPost)
                        <x-blog-card :post="$relatedPost" />
                    @empty
                        <div class="rounded-[1.75rem] border border-dashed border-stone-300 bg-white p-8 text-sm text-slate-600 md:col-span-2 xl:col-span-3">
                            No related posts available yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
