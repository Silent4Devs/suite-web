<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\AlcancesNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class AlcancesListener implements ShouldQueue
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
        $lista = ListaDistribucion::with('participantes')->where('modelo', 'AlcanceSgsi')->first();

        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            Notification::send($user, new AlcancesNotification($event->alcances, $event->tipo_consulta, $event->tabla, $event->slug));
        }
    }
}
