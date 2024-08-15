<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\ListaInformativa;
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

        $modulo_day = 2;

        $lista = ListaInformativa::with('participantes')->where('id', $modulo_day)->first();

        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            Notification::send($user, new SolicitudDayofNotification($event->solicitud_dayof, $event->tipo_consulta, $event->tabla, $event->slug));
        }
    }
}
