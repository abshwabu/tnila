<div class="space-y-6">
    <div class="flex flex-col gap-4 rounded-[1.75rem] border border-stone-200 bg-white p-5 shadow-sm lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Filter projects</p>
            <h2 class="mt-2 font-display text-2xl text-slate-950">Browse work by industry</h2>
        </div>

        <div class="flex flex-wrap gap-2">
            <button type="button" wire:click="$set('industrySlug', '')" class="{{ $industrySlug === '' ? 'bg-slate-950 text-stone-50' : 'bg-stone-100 text-slate-700 hover:bg-stone-200' }} rounded-full px-4 py-2 text-sm font-semibold transition duration-200 ease-out">
                All
            </button>
            @foreach ($industries as $industry)
                <button type="button" wire:click="$set('industrySlug', '{{ $industry->slug }}')" class="{{ $industrySlug === $industry->slug ? 'bg-amber-500 text-slate-950' : 'bg-stone-100 text-slate-700 hover:bg-stone-200' }} rounded-full px-4 py-2 text-sm font-semibold transition duration-200 ease-out">
                    {{ $industry->name }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($projects as $project)
            <x-project-card :project="$project" />
        @empty
            <div class="rounded-[1.75rem] border border-dashed border-stone-300 bg-white p-8 text-sm text-slate-600 md:col-span-2 xl:col-span-3">
                No projects match this filter yet.
            </div>
        @endforelse
    </div>
</div>
