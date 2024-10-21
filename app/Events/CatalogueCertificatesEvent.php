<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CatalogueCertificatesEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $certificate;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public $public;

    /**
     * Create a new event instance.
     */
    public function __construct($certificate, $tipo_consulta, $tabla, $slug, $public)
    {
        $this->certificate = $certificate;
        $this->tipo_consulta = $tipo_consulta;
        $this->tabla = $tabla;
        $this->slug = $slug;
        $this->public = $public;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notificaciones-campana');
    }
}
