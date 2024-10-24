<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\SolicitudVacacionesNotification;
use Auth;
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
        try {
            $user = Auth::user();

            if ($user) {
                // Obtén el supervisor usando la relación y evita llamar a removeUnicodeCharacters si no es necesario
                $supervisor = $user->empleado->supervisor ?? null;

                if ($supervisor) {
                    $supervisorEmail = trim(removeUnicodeCharacters($supervisor->email));
                    $supervisor = User::where('email', $supervisorEmail)->first();

                    if ($supervisor) {
                        Notification::send($supervisor, new SolicitudVacacionesNotification($event->solicitud_vacation, $event->tipo_consulta, $event->tabla, $event->slug));
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
