@props(['testimonial'])

<article class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm">
    <div class="flex items-center gap-1 text-amber-500">
        @for ($i = 0; $i < 5; $i++)
            <svg viewBox="0 0 20 20" class="h-4 w-4 fill-current" aria-hidden="true">
                <path d="m9.049 2.927c.3-.921 1.603-.921 1.902 0l1.1 3.384a1 1 0 0 0 .95.69h3.558c.969 0 1.371 1.24.588 1.81l-2.88 2.093a1 1 0 0 0-.364 1.118l1.1 3.384c.3.92-.755 1.688-1.538 1.118l-2.88-2.093a1 1 0 0 0-1.176 0l-2.88 2.093c-.783.57-1.838-.197-1.539-1.118l1.1-3.384a1 1 0 0 0-.363-1.118L2.854 8.811c-.783-.57-.38-1.81.588-1.81H6.999a1 1 0 0 0 .951-.69l1.1-3.384Z"/>
            </svg>
        @endfor
    </div>

    <p class="mt-5 text-sm leading-6 text-slate-700">“{{ $testimonial->content }}”</p>

    <div class="mt-6 flex items-center gap-3">
        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-950 text-sm font-semibold text-stone-50">
            {{ \Illuminate\Support\Str::of($testimonial->author_name)->substr(0, 1)->upper() }}
        </div>
        <div>
            <p class="font-semibold text-slate-950">{{ $testimonial->author_name }}</p>
            <p class="text-sm text-slate-500">
                {{ $testimonial->author_role }}
                @if ($testimonial->company)
                    · {{ $testimonial->company }}
                @endif
            </p>
        </div>
    </div>
</article>
