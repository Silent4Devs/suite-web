<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// validacion de canal privado para notificaciones de usuario autenticados
Broadcast::channel('user-notifications', function ($user) {
    return $user != null;
});

// validacion de canal privado para notificaciones de usuario autenticados
Broadcast::channel('notificaciones-campana', function ($user) {
    return $user != null;
});
