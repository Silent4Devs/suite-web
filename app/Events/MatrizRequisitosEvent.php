<?php

namespace App\Events;

use App\Jobs\MatrizRequisitosJob;
use App\Models\MatrizRequisitoLegale;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatrizRequisitosEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $matriz;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(MatrizRequisitoLegale $matriz, $tipo_consulta, $tabla, $slug)
    {
        $this->matriz = $matriz;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;

        MatrizRequisitosJob::dispatch($this->matriz, $this->tipo_consulta, $this->tabla, $this->slug);
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
