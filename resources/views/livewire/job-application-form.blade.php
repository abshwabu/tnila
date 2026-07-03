<div class="rounded-[1.75rem] border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Apply now</p>
            <h3 class="mt-3 font-display text-2xl text-slate-950">Application for {{ $jobListing->title }}</h3>
        </div>
        <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-800 ring-1 ring-amber-100">Resume upload required</span>
    </div>

    @if ($submitted)
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900" role="status" aria-live="polite">
            Thanks, your application has been submitted. Please check your inbox for confirmation.
        </div>
    @endif

    <form wire:submit="submit" class="mt-6 grid gap-4">
        <div class="grid gap-4 md:grid-cols-2">
            <label class="grid gap-2">
                <span class="text-sm font-medium text-slate-700">Full name</span>
                <input wire:model.live="applicantName" type="text" aria-invalid="{{ $errors->has('applicantName') ? 'true' : 'false' }}" aria-describedby="job-application-name-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
                @error('applicantName') <span id="job-application-name-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
            </label>
            <label class="grid gap-2">
                <span class="text-sm font-medium text-slate-700">Email</span>
                <input wire:model.live="email" type="email" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" aria-describedby="job-application-email-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
                @error('email') <span id="job-application-email-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
            </label>
        </div>

        <label class="grid gap-2">
            <span class="text-sm font-medium text-slate-700">Phone</span>
            <input wire:model.live="phone" type="text" aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}" aria-describedby="job-application-phone-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20" />
            @error('phone') <span id="job-application-phone-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
        </label>

        <label class="grid gap-2">
            <span class="text-sm font-medium text-slate-700">Resume</span>
            <input wire:model.live="resume" type="file" accept=".pdf,.doc,.docx" aria-invalid="{{ $errors->has('resume') ? 'true' : 'false' }}" aria-describedby="job-application-resume-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm file:mr-4 file:rounded-full file:border-0 file:bg-slate-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-stone-50 focus:border-amber-500 focus:ring-amber-500/20" />
            @error('resume') <span id="job-application-resume-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
        </label>

        <label class="grid gap-2">
            <span class="text-sm font-medium text-slate-700">Cover letter</span>
            <textarea wire:model.live="coverLetter" rows="6" aria-invalid="{{ $errors->has('coverLetter') ? 'true' : 'false' }}" aria-describedby="job-application-cover-letter-error" class="rounded-2xl border-stone-300 bg-stone-50 px-4 py-3 text-sm focus:border-amber-500 focus:ring-amber-500/20"></textarea>
            @error('coverLetter') <span id="job-application-cover-letter-error" class="text-sm text-red-600" role="alert">{{ $message }}</span> @enderror
        </label>

        <div class="pt-2">
            <x-button type="submit" wire:loading.attr="disabled">Submit application</x-button>
        </div>
    </form>
</div>
