<?php

// app/Notifications/ActivityNotification.php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

// JANGAN gunakan ShouldQueue jika ingin langsung terkirim
class ActivityNotification extends Notification
{
    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->details['subject'])
                    ->greeting('Halo!')
                    ->line($this->details['body'])
                    ->action('Lihat Detail', $this->details['actionURL'] ?? url('/'))
                    ->salutation('Salam, ' . config('app.name'));
    }
}
