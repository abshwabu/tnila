@props([
    'section' => null,
    'settings' => null,
    'items' => null,
])

@php
    use App\Support\Site;

    $content = is_array($section?->content) ? $section->content : [];
    $eyebrow = $content['eyebrow'] ?? 'Featured projects';
    $heading = $content['heading'] ?? 'Selected work that speaks for itself';
    $subheading = $content['subheading'] ?? 'Explore builds completed on time, within budget, and to exacting specifications.';
    $featuredCount = (int) ($content['featured_count'] ?? 4);
    $showFilterTabs = (bool) ($content['show_filter_tabs'] ?? true);
    $viewAllLabel = $content['view_all_label'] ?? 'All projects →';
    $buttons = is_array($content['buttons'] ?? null) ? $content['buttons'] : [];

    $allFeatured = $items['projects'] ?? \App\Models\Project::query()->with(['industry', 'customer'])->where('featured', true)->latest('updated_at')->get();
    $projects = $allFeatured->take($featuredCount > 0 ? $featuredCount : 4);
    $industries = $items['industries'] ?? collect();
@endphp

<x-section-wrapper :section="$section" anchor="projects">
    <div class="reveal opacity-0 translate-y-6" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true" :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-2xl">
                @if(filled($eyebrow))
                    <p class="section-kicker">{{ $eyebrow }}</p>
                @endif
                <h2 class="section-title mt-2">{{ $heading }}</h2>
                @if(filled($subheading))
                    <p class="section-copy mt-3">{{ $subheading }}</p>
                @endif
            </div>

            @if(filled($viewAllLabel))
                <a href="{{ route('projects.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-700 transition duration-200 ease-out hover:text-slate-950">
                    {{ $viewAllLabel }}
                </a>
            @endif
        </div>

        @if($showFilterTabs && $industries->isNotEmpty())
            <div class="mt-8 flex flex-wrap gap-2">
                <a href="{{ route('projects.index') }}" class="rounded-full border border-stone-200 bg-white px-4 py-1.5 text-xs font-semibold text-slate-800 shadow-sm transition hover:bg-stone-50 hover:border-stone-300">
                    All Sectors
                </a>
                @foreach ($industries as $industry)
                    <a href="{{ route('projects.by-industry', $industry) }}" class="rounded-full border border-stone-200 bg-white px-4 py-1.5 text-xs font-semibold text-slate-600 shadow-sm transition hover:text-slate-950 hover:bg-stone-50 hover:border-stone-300">
                        {{ $industry->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($projects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>

        @if(! empty($buttons))
            <div class="mt-10 flex flex-wrap gap-3">
                @foreach ($buttons as $btn)
                    @if(filled($btn['label'] ?? null))
                        @php
                            $btnUrl = ($btn['link_type'] ?? 'url') === 'section' && filled($btn['target'] ?? null)
                                ? '#' . $btn['target']
                                : ($btn['url'] ?? '#');
                            $btnVariant = match ($btn['style'] ?? 'primary') {
                                'secondary' => 'secondary',
                                'ghost' => 'ghost',
                                default => 'primary',
                            };
                        @endphp
                        <x-button :href="$btnUrl" :variant="$btnVariant">
                            {{ $btn['label'] }}
                        </x-button>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</x-section-wrapper>
