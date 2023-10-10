<?php

namespace App\Events;

use App\Models\AccionCorrectiva;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccionCorrectivaEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $accion_correctiva;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(AccionCorrectiva $accion_correctiva, $tipo_consulta, $tabla, $slug)
    {
        $this->accion_correctiva = $accion_correctiva;
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
