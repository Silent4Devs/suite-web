<?php

namespace App\Listeners;

use App\Events\EvaluacionEvent;
use App\Models\User;
use App\Notifications\EvaluacionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class EvaluacionListener implements ShouldQueue
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
    public function handle(EvaluacionEvent $event)
    {
        // corregir
        User::select('users.id', 'users.name', 'users.email', 'role_user.role_id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', '=', '1')->where('users.id', '!=', auth()->id())
            ->get()
            ->each(function (User $user) use ($event) {
                Notification::send($user, new EvaluacionNotification($event->evaluacion, $event->tipo_consulta, $event->tabla, $event->slug));
            });
    }
}
