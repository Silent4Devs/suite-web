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
        $user = User::getCurrentUser();
        $supervisor = User::where('email', trim(removeUnicodeCharacters($user->empleado->supervisor->email)))->first();
        Notification::send($supervisor, new TimesheetNotification($event->timeshet, $event->tipo_consulta, $event->tabla, $event->slug));
    }
}
