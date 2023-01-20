<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MyResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $token;

    public function __construct($token)
    {
        //
        $this->token = $token;
    }

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
            ->subject('Restablecimiento de contraseña.')
            ->line([
                'Recibimos una solicitud de restablecimiento de contraseña para su cuenta.',
            ])
            ->line([
                'Este enlace caducará en 60 minutos.',
            ])
            ->line([
                'En caso de cualquier duda, favor de contactar al equipo de soporte',
                'contacto@silent4business.com',

            ])
            ->line([

                'Haga clic en el botón de abajo para restablecer su contraseña:',
            ])
            ->action('Restablecer contraseña', url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false)))
            ->line('Si usted no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
