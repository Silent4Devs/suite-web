<?php

namespace App\Events;

use App\Models\ContractManager\Contrato;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContratoEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contratos;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(Contrato $contratos, $tipo_consulta, $tabla, $slug)
    {
        $this->contratos = $contratos;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;

        ContratosJob::dispatch($this->contratos, $this->tipo_consulta, $this->tabla, $this->slug);
    }

    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
