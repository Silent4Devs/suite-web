<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskRecursosEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tabla;

    public $slug;

    public $mensaje;

    public $user;

    public $tipo_notificacion;

    public function __construct($tabla, $slug, $mensaje, $user, $tipo_notificacion)
    {
        $this->tabla = $tabla;
        $this->slug = $slug;
        $this->mensaje = $mensaje;
        $this->user = $user;
        $this->tipo_notificacion = $tipo_notificacion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Users.Models.'.$this->user);
    }
}
