<div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Contact form</p>
            <h3 class="mt-3 font-display text-2xl text-slate-950">Tell us what you are planning</h3>
        </div>
        <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-800 ring-1 ring-amber-100">Response within 1 business day</span>
    </div>

    @if ($submitted)
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
            Thanks, your message has been sent. We will be in touch soon.
        </div>
    @endif

    <form wire:submit="submit" class="mt-6 grid gap-4">
        <div class="grid gap-4 md:grid-cols-2">
            <label class="grid gap-2">
                <span class="text-sm font-medium text-slate-700">Name</span>
                <input wire:model.live="name" type="text" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </label>
            <label class="grid gap-2">
                <span class="text-sm font-medium text-slate-700">Email</span>
                <input wire:model.live="email" type="email" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </label>
        </div>

        <label class="grid gap-2">
            <span class="text-sm font-medium text-slate-700">Phone</span>
            <input wire:model.live="phone" type="text" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
            @error('phone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="grid gap-2">
            <span class="text-sm font-medium text-slate-700">Project details</span>
            <textarea wire:model.live="message" rows="6" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20"></textarea>
            @error('message') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </label>

        <div class="pt-2">
            <x-button type="submit" wire:loading.attr="disabled">Send inquiry</x-button>
        </div>
    </form>
</div>
