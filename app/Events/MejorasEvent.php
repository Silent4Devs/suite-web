<?php

namespace App\Events;

use App\Models\Mejoras;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MejorasEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mejoras;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(Mejoras $mejoras, $tipo_consulta, $tabla, $slug)
    {
        $this->mejoras = $mejoras;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
