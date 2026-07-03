@props([
    'title' => 'Ready to start your project?',
    'description' => 'Tell us what you are planning and we will help shape the next step.',
    'primaryLabel' => 'Get a quote',
    'primaryHref' => route('contact'),
    'secondaryLabel' => 'Start your project',
    'secondaryHref' => route('services.index'),
])

<section {{ $attributes->merge(['class' => 'relative overflow-hidden rounded-[2rem] border border-stone-200 bg-slate-950 px-6 py-12 text-stone-50 shadow-sm sm:px-8']) }}>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(251,191,36,0.16),transparent_28%),radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.06),transparent_25%)]"></div>
    <div class="relative grid gap-6 lg:grid-cols-[1.1fr_auto] lg:items-center">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">Let's build</p>
            <h2 class="mt-3 font-display text-3xl leading-tight text-stone-50 sm:text-4xl">{{ $title }}</h2>
            <p class="mt-4 max-w-2xl text-sm leading-6 text-stone-300 sm:text-base">{{ $description }}</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <x-button :href="$primaryHref">{{ $primaryLabel }}</x-button>
            <x-button :href="$secondaryHref" variant="ghost" class="border-stone-700 text-stone-50 hover:bg-white/5">{{ $secondaryLabel }}</x-button>
        </div>
    </div>
</section>
