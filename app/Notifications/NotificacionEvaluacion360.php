<?php

namespace App\Notifications;

use App\Mail\RH\Evaluaciones\NotificacionEvaluador;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class NotificacionEvaluacion360 extends Notification
{
    use Queueable;

    public $email;

    public $evaluacion;

    public $evaluador;

    public $evaluado;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $evaluacion, $evaluador, $evaluado)
    {
        $this->email = $email;
        $this->evaluacion = $evaluacion;
        $this->evaluador = $evaluador;
        $this->evaluado = $evaluado;
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
        return Mail::to(removeUnicodeCharacters($this->email))->queue(new NotificacionEvaluador($this->evaluacion, $this->evaluador, $this->evaluados));
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
