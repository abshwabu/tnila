<?php

namespace App\Livewire;

use App\Models\JobApplication;
use App\Models\JobListing;
use App\Notifications\JobApplicationConfirmationNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class JobApplicationForm extends Component
{
    use WithFileUploads;

    public JobListing $jobListing;

    #[Validate('required|string|max:255')]
    public string $applicantName = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:255')]
    public string $phone = '';

    #[Validate('nullable|string|min:20')]
    public ?string $coverLetter = null;

    #[Validate('required|file|mimes:pdf,doc,docx|max:5120')]
    public $resume = null;

    public bool $submitted = false;

    public function mount(JobListing $jobListing): void
    {
        $this->jobListing = $jobListing;
    }

    public function submit(): void
    {
        $validated = $this->validate();

        $resumePath = $this->resume->store('resumes', 'public');

        $application = JobApplication::create([
            'job_listing_id' => $this->jobListing->id,
            'applicant_name' => $validated['applicantName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'resume' => $resumePath,
            'cover_letter' => $validated['coverLetter'] ?: null,
            'status' => 'new',
            'created_at' => now(),
        ]);

        Notification::route('mail', $application->email)->notify(new JobApplicationConfirmationNotification($application->load('jobListing')));

        $this->reset(['applicantName', 'email', 'phone', 'coverLetter', 'resume']);
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.job-application-form');
    }
}
