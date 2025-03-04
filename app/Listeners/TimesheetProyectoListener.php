<?php

namespace App\Listeners;

use App\Events\TimesheetProyectoEvent;
use App\Models\Empleado;
use App\Models\ListaInformativa;
use App\Models\User;
use App\Notifications\TimesheetProyectoNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TimesheetProyectoListener implements ShouldQueue
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
    public function handle(TimesheetProyectoEvent $event)
    {
        try {
            $lista = ListaInformativa::with('participantes')->where('modelo', 'TimesheetProyecto')->first();

            foreach ($lista->participantes as $participantes) {
                $empleados = Empleado::where('id', $participantes->empleado_id)->first();

                $user = User::where('email', trim(removeUnicodeCharacters($empleados->email)))->first();

                Notification::send($user, new TimesheetProyectoNotification($event->timeshet_proyecto, $event->tipo_consulta, $event->tabla, $event->slug));
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
