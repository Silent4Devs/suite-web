<?php

namespace App\Listeners;

use App\Events\UserSessionChanged;
use Illuminate\Auth\Events\Login;

class BroadcastUserLoginNotification
{
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
    public function handle(Login $event)
    {
        // Check if the user is authenticated
        // if ($event->user) {
        //     // User is authenticated, broadcast login notification
        //     broadcast(new UserSessionChanged("{$event->user->name} is online", 'success'));
        // }
    }
}
