<?php

namespace App\Notifications;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminContactSubmissionNotification extends Notification
{
    use Queueable;

    public function __construct(public ContactSubmission $submission)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New contact submission from ' . $this->submission->name)
            ->greeting('New website inquiry received')
            ->line('Name: ' . $this->submission->name)
            ->line('Email: ' . $this->submission->email)
            ->line('Phone: ' . ($this->submission->phone ?: 'Not provided'))
            ->line('Source page: ' . $this->submission->source_page)
            ->line('Message: ' . $this->submission->message);
    }
}
