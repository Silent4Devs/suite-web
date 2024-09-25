<?php

namespace App\Events;

use App\Models\TimesheetProyecto;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TimesheetProyectoEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $timesheet_proyecto;

    public $tipo_consulta;

    public $tabla;

    public $slug;

    public function __construct(TimesheetProyecto $timesheet_proyecto, $tipo_consulta, $tabla, $slug)
    {
        $this->timesheet_proyecto = $timesheet_proyecto;
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
