<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaTareasNotificacionesComponent extends Component
{
    public $notificaciones_sin_leer;

    protected $listeners = [
        'render-task-list' => 'render',
        'TaskMarkedAsReadList' => 'render',
    ];

    public function mount($notificaciones_sin_leer)
    {
        $this->notificaciones_sin_leer = $notificaciones_sin_leer;
    }

    public function render()
    {
        $last_unread_notifications = Auth::user()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->latest()->take(5)->get();

        return view('livewire.lista-tareas-notificaciones-component', [
            'last_unread_notifications' => $last_unread_notifications,
        ]);
    }
}
