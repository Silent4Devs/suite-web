<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\ListaInformativa;
use App\Models\User;
use App\Notifications\SolicitudVacacionesNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SolicitudVacacionesListener implements ShouldQueue
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
        $modulo_vacaciones = 1;

        $lista = ListaInformativa::with('participantes')->where('id', $modulo_vacaciones)->first();

        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            Notification::send($user, new SolicitudVacacionesNotification($event->solicitud_vacation, $event->tipo_consulta, $event->tabla, $event->slug));
        }
    }
}
