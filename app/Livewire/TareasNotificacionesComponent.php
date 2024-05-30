<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TareasNotificacionesComponent extends Component
{
    public $notificaciones_sin_leer;

    protected $listeners = [
        'render-task-count' => 'getTotalNotificaciones',
        'TaskMarkedAsReadList' => 'getTotalNotificaciones',
    ];

    public function mount()
    {
    }

    public function render()
    {
        $this->notificaciones_sin_leer = Auth::user()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->count();

        return view('livewire.tareas-notificaciones-component');
    }

    public function getTotalNotificaciones()
    {
        $this->notificaciones_sin_leer = Auth::user()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->count();
    }
}
