<section
    class="rounded-[2rem] border border-stone-200 bg-white p-6 shadow-sm sm:p-8"
    wire:poll.8s="next"
    x-data
    tabindex="0"
    aria-roledescription="carousel"
    aria-label="Customer testimonials"
    @keydown.left.prevent="$wire.previous()"
    @keydown.right.prevent="$wire.next()"
>
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Client stories</p>
            <h2 class="mt-3 font-display text-3xl text-slate-950">What clients say about the work</h2>
        </div>
        <div class="flex gap-2">
            <button type="button" wire:click="previous" aria-label="Previous testimonial" class="rounded-full border border-stone-200 px-4 py-2 text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:border-stone-300 hover:bg-stone-100">Prev</button>
            <button type="button" wire:click="next" aria-label="Next testimonial" class="rounded-full border border-slate-950 bg-slate-950 px-4 py-2 text-sm font-semibold text-stone-50 transition duration-200 ease-out hover:bg-slate-800">Next</button>
        </div>
    </div>

    @if ($current)
        <div class="mt-8 grid gap-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <x-testimonial-card :testimonial="$current" />
            <div class="rounded-[1.75rem] border border-stone-200 bg-stone-50 p-6">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Featured testimonial</p>
                <p class="mt-4 text-2xl leading-tight text-slate-950">“{{ \Illuminate\Support\Str::limit($current->content, 160) }}”</p>
                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach ($testimonials as $index => $testimonial)
                        <button type="button" wire:click="select({{ $index }})" class="{{ $index === $this->index ? 'bg-slate-950 text-stone-50' : 'bg-white text-slate-700 hover:bg-stone-100' }} rounded-full px-3 py-2 text-xs font-semibold transition duration-200 ease-out">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="mt-8 rounded-[1.75rem] border border-dashed border-stone-300 bg-stone-50 p-8 text-sm text-slate-600">
            No approved testimonials yet.
        </div>
    @endif
</section>
