<div class="space-y-6">
    <div class="flex flex-col gap-4 rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm sm:p-8 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">FAQ filter</p>
            <h2 class="mt-3 font-display text-3xl text-slate-950">Find answers faster</h2>
        </div>

        <label class="grid gap-2">
            <span class="text-sm font-medium text-slate-700">Filter category</span>
            <select wire:model.live="category" class="min-w-56 rounded-full border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20">
                <option value="all">All categories</option>
                @foreach ($categories as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="space-y-3">
        @forelse ($faqs as $faq)
            <section class="overflow-hidden rounded-[1.5rem] border border-stone-200 bg-white shadow-sm">
                <button type="button" wire:click="toggle({{ $faq->id }})" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-700">{{ $faq->category }}</p>
                        <h3 class="mt-2 text-base font-semibold text-slate-950">{{ $faq->question }}</h3>
                    </div>
                    <span class="flex h-10 w-10 items-center justify-center rounded-full border border-stone-200 text-slate-700">
                        {{ $openFaqId === $faq->id ? '−' : '+' }}
                    </span>
                </button>

                @if ($openFaqId === $faq->id)
                    <div class="px-6 pb-6 text-sm leading-6 text-slate-600">
                        {{ $faq->answer }}
                    </div>
                @endif
            </section>
        @empty
            <div class="rounded-[1.75rem] border border-dashed border-stone-300 bg-white p-8 text-sm text-slate-600">
                No FAQs found for this category.
            </div>
        @endforelse
    </div>
</div>
