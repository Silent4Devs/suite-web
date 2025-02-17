<?php

namespace App\Notifications;

use App\Models\RiesgoIdentificado;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class RiesgoNotification extends Notification
{
    use Queueable;

    public $riesgos;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(RiesgoIdentificado $riesgos, $tipo_consulta, $tabla, $slug)
    {
        $this->riesgos = $riesgos;
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
            'id' => $this->riesgos->id,
            'folio' => $this->riesgos->folio,
            'time' => Carbon::now(),
            'type' => $this->tipo_consulta,
            'tabla' => $this->tabla,
            'slug' => $this->slug,
            // 'name' => Auth::user()->name,
            // 'avatar_ruta' => Auth::user()->empleado->avatar_ruta,
        ];
    }
}
