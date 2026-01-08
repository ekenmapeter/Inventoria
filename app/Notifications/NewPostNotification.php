<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewPostNotification extends Notification
{

    /**
     * Create a new notification instance.
     */
    public function __construct(public Post $post)
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
            ->subject("New reply in: {$this->post->topic->title}")
            ->greeting("Hi {$notifiable->name},")
            ->line("There's a new reply in the topic '{$this->post->topic->title}' by {$this->post->user->name}.")
            ->line("**Reply:** " . Str::limit(strip_tags($this->post->body), 100))
            ->action('View Reply', route('topics.show', $this->post->topic))
            ->line('Thank you for using our forum!');
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
