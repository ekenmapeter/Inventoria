<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRejected extends Notification
{

    public function __construct(public Payment $payment, public ?string $reason = null)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $paymentType = $this->payment->isMonthlyDue() ? 'Monthly Dues' : 'Subscription';

        $mail = (new MailMessage)
            ->subject("Your {$paymentType} Payment Has Been Rejected")
            ->greeting("Hello {$notifiable->name},")
            ->line("Unfortunately, your {$paymentType} payment of ₦" . number_format((float)$this->payment->amount, 2) . " has been rejected.")
            ->line("Payment Details:")
            ->line("- Amount: ₦" . number_format((float)$this->payment->amount, 2))
            ->line("- Payment Method: " . ucfirst(str_replace('_', ' ', $this->payment->payment_method)))
            ->line("- Status: Rejected");

        if ($this->reason) {
            $mail->line("Reason: {$this->reason}");
    }

        $mail->line("Please review your payment and submit a new one if needed.")
            ->action('View Payments', route('payments.index'))
            ->line('If you have any questions, please contact the administrator.');

        return $mail;
    }

    public function toArray(object $notifiable): array
    {
        return [
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
            'type' => $this->payment->type,
            'reason' => $this->reason,
        ];
    }
}
