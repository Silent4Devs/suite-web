<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class TareasNotificacionesComponent extends Component
{
    public $notificaciones_sin_leer;

    protected $listeners = [
        'render-task-count' => 'getTotalNotificaciones',
        'TaskMarkedAsReadList' => 'getTotalNotificaciones',
    ];

    public function mount() {}

    public function render()
    {
        $this->notificaciones_sin_leer = User::getCurrentUser()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->count();

        return view('livewire.tareas-notificaciones-component');
    }

    public function getTotalNotificaciones()
    {
        $this->notificaciones_sin_leer = User::getCurrentUser()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->count();
    }
}
