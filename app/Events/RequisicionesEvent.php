<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequisicionesEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $requsicion;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct($requsicion, $tipo_consulta, $tabla, $slug)
    {
        try {
            $this->requsicion = $requsicion;
            $this->tipo_consulta = $tipo_consulta;
            $this->tabla = $tabla;
            $this->slug = $slug;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        try {
            \Log::debug('retorno notificacion');

            return new Channel('notificaciones-campana');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
