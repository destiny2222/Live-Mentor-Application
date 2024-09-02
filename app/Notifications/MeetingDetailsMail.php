<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingDetailsMail extends Notification
{
    use Queueable;

    public $meetingDetails;

    public function __construct($meetingDetails)
    {
        $this->meetingDetails = $meetingDetails;
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
            ->line('You have a new meeting scheduled.')
            ->action('Join Meeting', url('/join-meeting/'.$this->meetingDetails['data']['id']))
            ->line('Meeting Password: '.$this->meetingDetails['data']['password'])
            ->markdown('mail.meeting-details', [
                'topic' => $this->meetingDetails['data']['topic'],
                'start_time' => $this->meetingDetails['data']['start_time'],
                'join_url' => $this->meetingDetails['data']['join_url'],
                'password' => $this->meetingDetails['data']['password'],
            ])
            ->line('Thank you for using our application!');
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
