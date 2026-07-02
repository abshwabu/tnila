<div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-600">Request a quote</p>
            <h3 class="mt-2 text-2xl font-semibold text-slate-900">Tell us about your next build</h3>
        </div>
        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">Response in 24h</span>
    </div>

    @if ($submitted)
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
            Thanks, your inquiry has been sent. We’ll get back to you shortly.
        </div>
    @endif

    <form wire:submit="submit" class="mt-6 grid gap-4">
        <div class="grid gap-4 md:grid-cols-2">
            <label class="grid gap-2">
                <span class="text-sm font-medium text-slate-700">Name</span>
                <input wire:model="name" type="text" class="rounded-2xl border border-stone-300 px-4 py-3 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20" />
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </label>
            <label class="grid gap-2">
                <span class="text-sm font-medium text-slate-700">Email</span>
                <input wire:model="email" type="email" class="rounded-2xl border border-stone-300 px-4 py-3 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20" />
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </label>
        </div>

        <label class="grid gap-2">
            <span class="text-sm font-medium text-slate-700">Phone</span>
            <input wire:model="phone" type="text" class="rounded-2xl border border-stone-300 px-4 py-3 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20" />
            @error('phone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="grid gap-2">
            <span class="text-sm font-medium text-slate-700">Project details</span>
            <textarea wire:model="message" rows="5" class="rounded-2xl border border-stone-300 px-4 py-3 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20"></textarea>
            @error('message') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </label>

        <div>
            <x-button type="submit">Send inquiry</x-button>
        </div>
    </form>
</div>
