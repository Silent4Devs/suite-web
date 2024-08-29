<?php

namespace App\Events;

use App\Models\Minutasaltadireccion;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MinutasEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $minutas;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(Minutasaltadireccion $minutas, $tipo_consulta, $tabla, $slug)
    {
        $this->minutas = $minutas;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
