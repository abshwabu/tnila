<?php

namespace Tests\Feature;

use App\Livewire\ContactForm;
use App\Models\ContactSubmission;
use App\Models\User;
use App\Notifications\AdminContactSubmissionNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_a_valid_contact_submission_and_notifies_the_admin(): void
    {
        $admin = $this->createAdminUser();
        Notification::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Jordan Smith')
            ->set('email', 'jordan@example.com')
            ->set('phone', '+1 555 010 2020')
            ->set('message', 'We need a site visit and a quote for our warehouse expansion project.')
            ->call('submit')
            ->assertSet('submitted', true)
            ->assertHasNoErrors();

        $submission = ContactSubmission::query()->where('email', 'jordan@example.com')->firstOrFail();

        $this->assertSame('Jordan Smith', $submission->name);
        $this->assertSame('new', $submission->status);

        Notification::assertSentTo($admin, AdminContactSubmissionNotification::class, function (AdminContactSubmissionNotification $notification) use ($submission): bool {
            return $notification->submission->is($submission);
        });
    }

    public function test_it_rejects_invalid_contact_submissions(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', '')
            ->set('email', 'not-an-email')
            ->set('message', 'Too short')
            ->call('submit')
            ->assertHasErrors([
                'name' => 'required',
                'email' => 'email',
                'message' => 'min',
            ]);

        $this->assertDatabaseCount('contact_submissions', 0);
    }

    private function createAdminUser(): User
    {
        Role::findOrCreate('Admin');

        $admin = User::factory()->create([
            'email' => 'admin@tnila.test',
            'name' => 'Admin',
        ]);

        $admin->assignRole('Admin');

        return $admin;
    }
}
