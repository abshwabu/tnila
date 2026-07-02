<header class="sticky top-0 z-40 border-b border-stone-200/80 bg-white/90 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8" x-data="{ open: false }">
        <a href="/" class="flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-sm font-black text-white">T</span>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-amber-600">Tnila</p>
                <p class="text-base font-semibold text-slate-900">Construction Company</p>
            </div>
        </a>

        <nav class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
            <a href="#services" class="transition hover:text-slate-900">Services</a>
            <a href="#projects" class="transition hover:text-slate-900">Projects</a>
            <a href="#contact" class="transition hover:text-slate-900">Contact</a>
            <a href="/admin" class="rounded-full border border-stone-300 px-4 py-2 transition hover:bg-stone-100">Admin</a>
        </nav>

        <button type="button" class="inline-flex items-center rounded-full border border-stone-300 px-4 py-2 text-sm font-medium md:hidden" @click="open = !open">
            Menu
        </button>
    </div>

    <div class="border-t border-stone-200 bg-white px-6 py-4 md:hidden" x-show="open" x-cloak>
        <div class="grid gap-3 text-sm font-medium text-slate-600">
            <a href="#services">Services</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
            <a href="/admin">Admin</a>
        </div>
    </div>
</header>
