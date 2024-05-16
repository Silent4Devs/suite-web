<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\EntendimientoOrganizacionNotification;
use Illuminate\Support\Facades\Notification;

class EntendimientoOrganizacionListener
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
        $modulo_entend = 1;

        $lista = ListaDistribucion::with('participantes')->where('id', $modulo_entend)->first();


        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            Notification::send($user, new EntendimientoOrganizacionNotification($event->entendimiento, $event->tipo_consulta, $event->tabla, $event->slug));
        }
    }
}