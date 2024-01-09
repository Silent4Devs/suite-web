<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaCampanaNotificacionesComponent extends Component
{
    public $notificaciones_sin_leer;

    protected $listeners = [
        'echo:notificaciones-campana,IncidentesDeSeguridadEvent' => 'render',
        'echo:notificaciones-campana,AuditoriaAnualEvent' => 'render',
        'echo:notificaciones-campana,AccionCorrectivaEvent' => 'render',
        'echo:notificaciones-campana,RegistroMejoraEvent' => 'render',
        'echo:notificaciones-campana,RecursosEvent' => 'render',
        'NotificationMarkedAsReadList' => 'render',
    ];

    public function mount($notificaciones_sin_leer)
    {
        $this->notificaciones_sin_leer = $notificaciones_sin_leer;
    }

    public function render()
    {
        $last_unread_notifications = Auth::user()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->latest()->take(5)->get();

        return view('livewire.lista-campana-notificaciones-component', ['last_unread_notifications' => $last_unread_notifications]);
    }
}
