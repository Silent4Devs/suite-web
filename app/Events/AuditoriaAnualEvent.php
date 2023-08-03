<?php

namespace App\Events;

use App\Models\AuditoriaAnual;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuditoriaAnualEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $auditoria_anual;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(AuditoriaAnual $auditoria_anual, $tipo_consulta, $tabla, $slug)
    {
        $this->auditoria_anual = $auditoria_anual;
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
        \Log::debug('retorno notificacion');

        return new Channel('notificaciones-campana');
    }
}
