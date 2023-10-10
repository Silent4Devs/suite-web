<?php

namespace App\Notifications;

use App\Models\Recurso;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class RecursosNotification extends Notification
{
    use Queueable;

    public $recurso;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(Recurso $recurso, $tipo_consulta, $tabla, $slug)
    {
        $this->recurso = $recurso;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->recurso->id,
            'nombre_curso' => $this->recurso->cursoscapacitaciones,
            'fecha_curso' => $this->recurso->fecha_curso,
            'instructor' => $this->recurso->instructor,
            'time' => Carbon::now(),
            'type' => $this->tipo_consulta,
            'tabla' => $this->tabla,
            'slug' => $this->slug,
            'name' => Auth::user()->name,
        ];
    }
}
