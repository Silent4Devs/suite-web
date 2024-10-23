<?php

namespace App\Events;

use App\Jobs\EntendimientoOrganizacionJob;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EntendimientoOrganizacionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $entendimiento;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct($entendimiento, $tipo_consulta, $tabla, $slug)
    {
        $this->entendimiento = $entendimiento;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;

        EntendimientoOrganizacionJob::dispatch($this->entendimiento, $this->tipo_consulta, $this->tabla, $this->slug);
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
