<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\CoursesNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class CoursesListener implements ShouldQueue
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
        User::select('users.id', 'users.name', 'users.email', 'role_user.role_id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', '=', '1')->where('users.id', '!=', auth()->id())
            ->get()
            ->each(function (User $user) use ($event) {
                Notification::send($user, new CoursesNotification($event->courses, $event->tipo_consulta, $event->tabla, $event->slug));
            });
    }
}
