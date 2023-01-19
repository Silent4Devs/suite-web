<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCodeNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verificación de dos factores')
            ->view('mails.two-factor.mail', compact('notifiable'));
        // ->line("Tu código de verificación por dos factores es: " . "$notifiable->two_factor_code")
        // ->action('Verifica Aquí', route('twoFactor.show'))
        // ->line("El código expirará en 15 minutos")
        // ->line("Sí no estás intentando logearte ignora este correo");
    }
}
