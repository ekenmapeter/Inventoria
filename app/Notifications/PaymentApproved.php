<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentApproved extends Notification
{

    public function __construct(public Payment $payment)
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

        return (new MailMessage)
            ->subject("Your {$paymentType} Payment Has Been Approved")
            ->greeting("Hello {$notifiable->name},")
            ->line("Your {$paymentType} payment of ₦" . number_format((float)$this->payment->amount, 2) . " has been approved.")
            ->line("Payment Details:")
            ->line("- Amount: ₦" . number_format((float)$this->payment->amount, 2))
            ->line("- Payment Method: " . ucfirst(str_replace('_', ' ', $this->payment->payment_method)))
            ->line("- Status: Approved")
            ->line("- Approved Date: " . $this->payment->approved_at->format('F d, Y g:i A'))
            ->action('View Dashboard', route('dashboard'))
            ->line('Thank you for your payment!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'payment_id' => $this->payment->id,
            'amount' => $this->payment->amount,
            'type' => $this->payment->type,
        ];
    }
}
