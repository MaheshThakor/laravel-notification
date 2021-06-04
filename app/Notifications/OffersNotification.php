<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OffersNotification extends Notification
{
    use Queueable;

    private $offerData;

    public function __construct($offerData)
    {
        $this->offerData = $offerData;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hi ' . $this->offerData['name'])
            ->line($this->offerData['body'])
            ->action($this->offerData['offerText'], $this->offerData['offerUrl'])
            ->line($this->offerData['thanks']);
    }


    public function toArray($notifiable)
    {
        return [
            'offer_id' => $this->offerData['offer_id']
        ];
    }
}
