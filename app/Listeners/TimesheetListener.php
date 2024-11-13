<?php

namespace App\Listeners;

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
            $user = User::getCurrentUser();
            $supervisor = User::where('email', trim(removeUnicodeCharacters($user->empleado->supervisor->email)))->first();
            Notification::send($supervisor, new TimesheetNotification($event->timesheet, $event->tipo_consulta, $event->tabla, $event->slug));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
