<?php

namespace App\Notifications;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobApplicationConfirmationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public JobApplication $application)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('We received your application for ' . $this->application->jobListing->title)
            ->greeting('Thanks for applying')
            ->line('We received your application for the role: ' . $this->application->jobListing->title)
            ->line('Our team will review your details and get back to you soon.')
            ->line('If you need to update anything, just reply to this email.');
    }
}
