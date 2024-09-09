<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessfulNotification extends Notification
{
    use Queueable;
    protected $paymentDetails;

    /**
     * Create a new notification instance.
     *
     * @param mixed $paymentDetails
     * @return void
     */
    public function __construct($paymentDetails)
    {
        $this->paymentDetails = $paymentDetails;
    }

    /**
     * Determine the channels the notification should be sent on.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $amount = $this->paymentDetails->amount ?? 'Unknown';
        $status = '';

        if ($this->paymentDetails instanceof \App\Models\Proposal) {
            $status = 'Proposal Payment Successful';
        } elseif ($this->paymentDetails instanceof \App\Models\BookSession) {
            $status = 'Session Payment Successful';
        }

        return (new MailMessage)
                    ->view('mail.payment_successful', [
                        'amount' => $amount,
                        'status' => $status,
                        'dashboardUrl' => url('/dashboard'),
                    ]);
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
