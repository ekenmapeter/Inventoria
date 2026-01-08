<?php

namespace App\Notifications;

use App\Models\Deposit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepositApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Deposit $deposit)
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
            ->subject('Your Deposit Has Been Approved')
            ->greeting("Hello {$notifiable->name},")
            ->line("Your deposit of ₦" . number_format((float)$this->deposit->amount, 2) . " has been approved.")
            ->line("Deposit Details:")
            ->line("- Amount: ₦" . number_format((float)$this->deposit->amount, 2))
            ->line("- Payment Method: " . ucfirst(str_replace('_', ' ', $this->deposit->payment_method)))
            ->line("- Status: Approved")
            ->line("- Approved Date: " . $this->deposit->approved_at->format('F d, Y g:i A'))
            ->action('View Dashboard', route('dashboard'))
            ->line('Your subscription is now active. Thank you for your deposit!');
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
