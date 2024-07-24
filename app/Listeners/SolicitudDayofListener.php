<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\SolicitudDayofNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SolicitudDayofListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $user = auth()->user();
        if ($user->empleado && $user->empleado->supervisor) {
            // Obtener al supervisor por su dirección de correo electrónico
            $supervisor = User::where('email', trim(removeUnicodeCharacters($user->empleado->supervisor->email)))->first();
        }
        Notification::send($supervisor, new SolicitudDayofNotification($event->solicitud_dayof, $event->tipo_consulta, $event->tabla, $event->slug));
    }
}