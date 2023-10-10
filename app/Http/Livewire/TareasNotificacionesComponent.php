<?php

namespace App\Http\Livewire;

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
        $this->notificaciones_sin_leer = Auth::user()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->count();
    }

    public function render()
    {
        return view('livewire.tareas-notificaciones-component');
    }

    public function getTotalNotificaciones()
    {
        $this->notificaciones_sin_leer = Auth::user()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->count();
    }
}
