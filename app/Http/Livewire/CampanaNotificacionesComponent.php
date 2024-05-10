<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CampanaNotificacionesComponent extends Component
{
    public $notificaciones;

    public $notificaciones_sin_leer;

    public function mount()
    {
        $this->notificaciones = Auth::user()->unreadNotifications()->latest()->take(5)->get();
    }

    public function render()
    {

        $this->notificaciones_sin_leer = Auth::user()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->count();

        return view('livewire.campana-notificaciones-component');
    }

    public function getTotalNotificaciones()
    {
        $this->notificaciones_sin_leer = Auth::user()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->count();
        $this->dispatchBrowserEvent('campana-notificaciones');
    }
}
