<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\TimesheetNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;


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

        $user = Auth::user();

        if ($user) {
            // Obtén el supervisor usando la relación y evita llamar a removeUnicodeCharacters si no es necesario
            $supervisor = $user->empleado->supervisor ?? null;

            if ($supervisor) {
                $supervisorEmail = trim(removeUnicodeCharacters($supervisor->email));
                $supervisor = User::where('email', $supervisorEmail)->first();

                if ($supervisor) {
                    Notification::send($supervisor, new TimesheetNotification($event->timeshet, $event->tipo_consulta, $event->tabla, $event->slug));
                }
            }
        }

    }
}
