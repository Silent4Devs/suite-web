<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\PoliticasSgiNotification;
use Illuminate\Support\Facades\Notification;

class PoliticasSgiListener
{
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
        $modulo_politicas = 3;

        $lista = ListaDistribucion::with('participantes')->where('id', $modulo_politicas)->first();

        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', $empleados->email)->first();

            Notification::send($user, new PoliticasSgiNotification($event->politicas, $event->tipo_consulta, $event->tabla, $event->slug));
        }
    }
}
