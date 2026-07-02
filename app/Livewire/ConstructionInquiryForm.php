<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ConstructionInquiryForm extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|max:255')]
    public string $phone = '';

    #[Validate('nullable|string|max:255')]
    public string $company = '';

    #[Validate('required|string|min:20')]
    public string $message = '';

    public bool $submitted = false;

    public function submit(): void
    {
        $validated = $this->validate();

        Inquiry::create([
            ...$validated,
            'status' => 'new',
        ]);

        $this->reset(['name', 'email', 'phone', 'company', 'message']);
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.construction-inquiry-form');
    }
}
