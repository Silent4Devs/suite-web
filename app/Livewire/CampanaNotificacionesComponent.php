<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CampanaNotificacionesComponent extends Component
{
    protected $listeners = [
        'echo:notificaciones-campana,IncidentesDeSeguridadEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,AuditoriaAnualEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,AccionCorrectivaEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,RegistroMejoraEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,RecursosEvent' => 'getTotalNotificaciones',
        'NotificationMarkedAsReadList' => 'getTotalNotificaciones',
    ];

    public $notificaciones_sin_leer;

    public function mount()
    {
        // $this->notificaciones = Auth::user()->unreadNotifications()->latest()->take(5)->get();
    }

    public function render()
    {
        $this->notificaciones_sin_leer = Auth::user()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->count();

        return view('livewire.campana-notificaciones-component');
    }

    public function getTotalNotificaciones()
    {
        $this->notificaciones_sin_leer = Auth::user()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->count();
        $this->dispatch('campana-notificaciones');
    }
}
