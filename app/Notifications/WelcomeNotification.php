<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to Mini Forum!')
            ->greeting("Welcome {$notifiable->name}!")
            ->line('Thank you for registering with Mini Forum. Your account has been created successfully.')
            ->line('You can now:')
            ->line('• Browse and participate in forum discussions')
            ->line('• Create topics and share your thoughts')
            ->line('• Make payments for subscriptions and donations')
            ->action('Visit Dashboard', route('dashboard'))
            ->line('If you have any questions, feel free to contact the administrator.')
            ->salutation('Best regards, Mini Forum Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
