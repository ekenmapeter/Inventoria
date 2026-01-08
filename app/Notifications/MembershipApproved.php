<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipApproved extends Notification
{

    /**
     * Create a new notification instance.
     */
    public function __construct(public Payment $payment)
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
            ->subject('Membership Approved - Welcome!')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Great news! Your payment of $' . number_format($this->payment->amount, 2) . ' has been approved.')
            ->line('Your subscription is now active and you can enjoy all the features of our forum.')
            ->action('Visit Forum', url('/'))
            ->line('Thank you for being a valued member!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
        ];
    }
}
