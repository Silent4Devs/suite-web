<?php

namespace App\Events;

use App\Models\RiesgoIdentificado;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RiesgosEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $riesgos;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(RiesgoIdentificado $riesgos, $tipo_consulta, $tabla, $slug)
    {
        $this->riesgos = $riesgos;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
