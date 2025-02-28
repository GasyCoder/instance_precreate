<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OtpVerification extends Notification
{
    use Queueable;

    private $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Vérification de votre compte')
            ->line('Votre code de vérification est : ' . $this->otp)
            ->line('Ce code expirera dans 10 minutes.')
            ->line('Si vous n\'avez pas créé de compte, aucune action n\'est requise.');
    }
}
