<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\MatrizRequisitosNotification;
use Illuminate\Support\Facades\Notification;

class MatrizRequisitosListener
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
        $modulo_matriz = 4;

        $lista = ListaDistribucion::with('participantes')->where('id', $modulo_matriz)->first();

        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', removeUnicodeCharacters($empleados->email))->first();

            Notification::send($user, new MatrizRequisitosNotification($event->matriz, $event->tipo_consulta, $event->tabla, $event->slug));
        }
    }
}