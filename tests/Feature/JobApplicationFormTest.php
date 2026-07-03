<?php

namespace Tests\Feature;

use App\Livewire\JobApplicationForm;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Notifications\JobApplicationConfirmationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class JobApplicationFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_an_application_and_uploads_the_resume(): void
    {
        Storage::fake('public');
        Notification::fake();

        $jobListing = JobListing::factory()->create([
            'status' => 'open',
        ]);

        $resume = UploadedFile::fake()->create('resume.pdf', 200, 'application/pdf');

        Livewire::test(JobApplicationForm::class, [
            'jobListing' => $jobListing,
        ])
            ->set('applicantName', 'Amina Kariuki')
            ->set('email', 'amina@example.com')
            ->set('phone', '+254700111222')
            ->set('coverLetter', 'I am excited to contribute to your delivery team.')
            ->set('resume', $resume)
            ->call('submit')
            ->assertSet('submitted', true)
            ->assertHasNoErrors();

        $application = JobApplication::query()->where('email', 'amina@example.com')->firstOrFail();

        Storage::disk('public')->assertExists($application->resume);
        Notification::assertSentOnDemandTimes(JobApplicationConfirmationNotification::class, 1);
    }

    public function test_it_requires_a_resume_file(): void
    {
        $jobListing = JobListing::factory()->create([
            'status' => 'open',
        ]);

        Livewire::test(JobApplicationForm::class, [
            'jobListing' => $jobListing,
        ])
            ->set('applicantName', 'Amina Kariuki')
            ->set('email', 'amina@example.com')
            ->set('phone', '+254700111222')
            ->set('coverLetter', 'I am excited to contribute to your delivery team.')
            ->call('submit')
            ->assertHasErrors(['resume' => 'required']);

        $this->assertDatabaseCount('job_applications', 0);
    }
}
