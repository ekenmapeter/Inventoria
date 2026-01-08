<?php

namespace App\Notifications;

use App\Models\Deposit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepositRejected extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Deposit $deposit, public ?string $reason = null)
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
        $mail = (new MailMessage)
            ->subject('Your Deposit Has Been Rejected')
            ->greeting("Hello {$notifiable->name},")
            ->line("Unfortunately, your deposit of ₦" . number_format((float)$this->deposit->amount, 2) . " has been rejected.")
            ->line("Deposit Details:")
            ->line("- Amount: ₦" . number_format((float)$this->deposit->amount, 2))
            ->line("- Payment Method: " . ucfirst(str_replace('_', ' ', $this->deposit->payment_method)))
            ->line("- Status: Rejected");

        if ($this->reason) {
            $mail->line("Reason: {$this->reason}");
        }

        $mail->line("Please review your deposit details and submit a new one if needed.")
            ->action('View Dashboard', route('dashboard'))
            ->line('If you have any questions, please contact the administrator.');

        return $mail;
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
