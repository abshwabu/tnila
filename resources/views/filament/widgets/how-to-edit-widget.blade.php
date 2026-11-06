<x-filament-widgets::widget class="fi-how-to-edit-widget">
    <x-filament::section
        icon="heroicon-o-light-bulb"
        icon-color="primary"
    >
        <x-slot name="heading">
            How to Customize the Tnela Website
        </x-slot>

        <x-slot name="description">
            Every visible element is database-driven and fully customizable through this admin dashboard.
        </x-slot>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Step 1 -->
            <div class="rounded-xl border border-gray-200/80 bg-gray-50/60 p-4.5 dark:border-white/10 dark:bg-white/[0.03]">
                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">
                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-amber-100 text-[11px] font-bold text-amber-800 dark:bg-amber-900/50 dark:text-amber-300">1</span>
                    <span>Global Settings</span>
                </div>
                <h4 class="mt-2 text-sm font-semibold text-gray-950 dark:text-white">Branding, Fonts &amp; Palette</h4>
                <p class="mt-1 text-xs leading-relaxed text-gray-600 dark:text-gray-400">
                    Open <strong class="font-medium text-gray-900 dark:text-gray-200">Site &gt; Site Settings</strong> to upload logos, switch Google Fonts (e.g. Sora, Inter, Playfair), change brand colors, edit navigation, and update the footer.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="rounded-xl border border-gray-200/80 bg-gray-50/60 p-4.5 dark:border-white/10 dark:bg-white/[0.03]">
                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-sky-600 dark:text-sky-400">
                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-sky-100 text-[11px] font-bold text-sky-800 dark:bg-sky-900/50 dark:text-sky-300">2</span>
                    <span>Page Sections</span>
                </div>
                <h4 class="mt-2 text-sm font-semibold text-gray-950 dark:text-white">Layout &amp; Section Copy</h4>
                <p class="mt-1 text-xs leading-relaxed text-gray-600 dark:text-gray-400">
                    Go to <strong class="font-medium text-gray-900 dark:text-gray-200">Site &gt; Page Sections</strong> to drag-and-drop section order, toggle visibility on/off, or edit individual headlines, subtitles, and backgrounds.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="rounded-xl border border-gray-200/80 bg-gray-50/60 p-4.5 dark:border-white/10 dark:bg-white/[0.03]">
                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-[11px] font-bold text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">3</span>
                    <span>Content Models</span>
                </div>
                <h4 class="mt-2 text-sm font-semibold text-gray-950 dark:text-white">Services, Projects &amp; Reviews</h4>
                <p class="mt-1 text-xs leading-relaxed text-gray-600 dark:text-gray-400">
                    Under <strong class="font-medium text-gray-900 dark:text-gray-200">Content</strong> and <strong class="font-medium text-gray-900 dark:text-gray-200">CRM</strong>, manage service catalog offerings, project photography, testimonials, and blog articles.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="rounded-xl border border-gray-200/80 bg-gray-50/60 p-4.5 dark:border-white/10 dark:bg-white/[0.03]">
                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-violet-600 dark:text-violet-400">
                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-violet-100 text-[11px] font-bold text-violet-800 dark:bg-violet-900/50 dark:text-violet-300">4</span>
                    <span>Instant Live Updates</span>
                </div>
                <h4 class="mt-2 text-sm font-semibold text-gray-950 dark:text-white">Automatic Cache Purging</h4>
                <p class="mt-1 text-xs leading-relaxed text-gray-600 dark:text-gray-400">
                    Every save automatically purges the cached site settings. Click <strong class="font-medium text-gray-900 dark:text-gray-200">View Live Site</strong> above to immediately verify your published changes.
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
