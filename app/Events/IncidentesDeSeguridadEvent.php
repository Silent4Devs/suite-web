<?php

namespace App\Events;

use App\Models\IncidentesSeguridad;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IncidentesDeSeguridadEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $incidentesSeguridad;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(IncidentesSeguridad $incidentesSeguridad, $tipo_consulta, $tabla, $slug)
    {
        $this->incidentesSeguridad = $incidentesSeguridad;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
