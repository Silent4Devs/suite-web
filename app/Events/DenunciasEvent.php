<?php

namespace App\Events;

use App\Models\Denuncias;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DenunciasEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $denuncias;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(Denuncias $denuncias, $tipo_consulta, $tabla, $slug)
    {
        $this->denuncias = $denuncias;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
    }

    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
