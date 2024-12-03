<?php

namespace App\Listeners;

use App\Models\Empleado;
use App\Models\User;
use App\Notifications\TimesheetNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TimesheetListener implements ShouldQueue
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


        try {
            $empleado = Empleado::where('id', $event->timesheet->empleado_id)->first();

            $user = User::where('email', trim(removeUnicodeCharacters($empleado->email)))->first();


            if ($user) {
                // Obtén el supervisor usando la relación y evita llamar a removeUnicodeCharacters si no es necesario
                $supervisor_empleado = $user->empleado->supervisor ?? null;

                if ($supervisor_empleado) {
                    $supervisor_usuario = User::where('email', trim(removeUnicodeCharacters($supervisor_empleado->email)))->first();
                    Notification::send($supervisor_usuario, new TimesheetNotification($event->timesheet, $event->tipo_consulta, $event->tabla, $event->slug));
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
