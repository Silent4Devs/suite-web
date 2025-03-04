<?php

namespace App\Listeners;

use App\Events\EntendimientoOrganizacionEvent;
use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\User;
use App\Notifications\EntendimientoOrganizacionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class EntendimientoOrganizacionListener implements ShouldQueue
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
    public function handle(EntendimientoOrganizacionEvent $event)
    {
        $lista = ListaDistribucion::with('participantes')->where('modelo', 'EntendimientoOrganizacion')->first();

        foreach ($lista->participantes as $participantes) {
            $empleados = Empleado::where('id', $participantes->empleado_id)->first();

            $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

            Notification::send($user, new EntendimientoOrganizacionNotification($event->entendimiento, $event->tipo_consulta, $event->tabla, $event->slug));
        }
    }
}
