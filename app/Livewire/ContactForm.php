<?php

namespace App\Livewire;

use App\Models\ContactSubmission;
use App\Models\User;
use App\Notifications\AdminContactSubmissionNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|max:255')]
    public string $phone = '';

    #[Validate('required|string|min:20')]
    public string $message = '';

    public bool $submitted = false;

    public function submit(): void
    {
        $validated = $this->validate();

        $submission = ContactSubmission::create([
            ...$validated,
            'status' => 'new',
            'source_page' => request()->path() ?: '/',
        ]);

        $adminEmail = User::role('Admin')->value('email') ?? config('mail.from.address');

        if ($adminEmail) {
            Notification::route('mail', $adminEmail)->notify(new AdminContactSubmissionNotification($submission));
        }

        $this->reset(['name', 'email', 'phone', 'message']);
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
