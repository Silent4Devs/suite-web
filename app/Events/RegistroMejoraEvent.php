<?php

namespace App\Events;

use App\Models\Registromejora;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegistroMejoraEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $registro_mejora;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Registromejora $registro_mejora, $tipo_consulta, $tabla, $slug)
    {
        $this->registro_mejora = $registro_mejora;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
