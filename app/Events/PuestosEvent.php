<?php

namespace App\Events;

use App\Models\Puesto;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PuestosEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $puestos;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(Puesto $puestos, $tipo_consulta, $tabla, $slug)
    {
        $this->puestos = $puestos;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
