<?php

namespace App\Notifications;

use App\Models\Mejoras;
use App\Models\Sugerencias;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class SugerenciasNotification extends Notification
{
    use Queueable;

    public $sugerencias;
    public $tipo_consulta;
    public $tabla;
    public $slug;

    public function __construct(Sugerencias $sugerencias, $tipo_consulta, $tabla, $slug)
    {
        $this->sugerencias = $sugerencias;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->sugerencias->id,
            'folio' => $this->sugerencias->folio,
            'time' => Carbon::now(),
            'type' => $this->tipo_consulta,
            'tabla' => $this->tabla,
            'slug' => $this->slug,
            'name' => Auth::user()->name,
            'avatar_ruta' => Auth::user()->empleado->avatar_ruta,
        ];
    }
}