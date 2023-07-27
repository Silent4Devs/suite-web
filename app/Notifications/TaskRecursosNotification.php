<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskRecursosNotification extends Notification
{
    use Queueable;

    public $tabla;

    public $slug;

    public $mensaje;

    public $user;

    public $tipo_notificacion;

    public function __construct($tabla, $slug, $mensaje, $user, $tipo_notificacion)
    {
        $this->tabla = $tabla;
        $this->slug = $slug;
        $this->mensaje = $mensaje;
        $this->user = $user;
        $this->tipo_notificacion = $tipo_notificacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'slug' => $this->slug,
            'mensaje' => $this->mensaje,
            'user' => $this->user->id,
        ]);
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
            'tabla' => $this->tabla,
            'slug' => $this->slug,
            'mensaje' => $this->mensaje,
            'user' => $this->user->id,
            'tipo_notificacion' => $this->tipo_notificacion,
        ];
    }
}
