<div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Contact form</p>
            <h3 class="mt-3 font-display text-2xl text-slate-950">Tell us what you are planning</h3>
        </div>
        <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-800 ring-1 ring-amber-100">Response within 1 business day</span>
    </div>

    @if ($submitted)
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-6 text-center" role="status" aria-live="polite">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="mt-3 text-base font-semibold text-emerald-900">Message sent successfully</p>
            <p class="mt-1 text-sm text-emerald-700">Thanks for reaching out. We will be in touch within 1 business day.</p>
            <button type="button" wire:click="$set('submitted', false)" class="mt-5 rounded-full border border-emerald-300 bg-white px-5 py-2 text-sm font-semibold text-emerald-800 transition duration-200 ease-out hover:bg-emerald-50">Send another message</button>
        </div>
    @else
        <form wire:submit="submit" class="mt-6 grid gap-4">
            <div class="grid gap-4 md:grid-cols-2">
                <label class="grid gap-2">
                    <span class="text-sm font-medium text-slate-700">Name</span>
                    <input wire:model.live="name" type="text" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" aria-describedby="contact-name-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
                    @error('name') <span id="contact-name-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
                </label>
                <label class="grid gap-2">
                    <span class="text-sm font-medium text-slate-700">Email</span>
                    <input wire:model.live="email" type="email" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" aria-describedby="contact-email-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
                    @error('email') <span id="contact-email-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
                </label>
            </div>

            <label class="grid gap-2">
                <span class="text-sm font-medium text-slate-700">Phone</span>
                <input wire:model.live="phone" type="text" aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}" aria-describedby="contact-phone-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
                @error('phone') <span id="contact-phone-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
            </label>

            <label class="grid gap-2">
                <span class="text-sm font-medium text-slate-700">Project details</span>
                <textarea wire:model.live="message" rows="6" aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}" aria-describedby="contact-message-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20"></textarea>
                @error('message') <span id="contact-message-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
            </label>

            <div class="pt-2">
                <x-button type="submit" wire:loading.attr="disabled">Send inquiry</x-button>
            </div>
        </form>
    @endif
</div>
