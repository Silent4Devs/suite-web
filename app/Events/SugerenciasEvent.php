<?php

namespace App\Events;

use App\Models\Sugerencias;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SugerenciasEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sugerencias;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(Sugerencias $sugerencias, $tipo_consulta, $tabla, $slug)
    {
        $this->sugerencias = $sugerencias;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
