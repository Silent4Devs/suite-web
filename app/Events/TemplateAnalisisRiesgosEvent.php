<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TemplateAnalisisRiesgosEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;

    public $step;

    public $tipo_consulta;

    /**
     * Create a new event instance.
     */
    public function __construct($model, $tipo_consulta)
    {

        $this->step = class_basename($model);
        $this->model = $model;
        $this->tipo_consulta = $tipo_consulta;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
