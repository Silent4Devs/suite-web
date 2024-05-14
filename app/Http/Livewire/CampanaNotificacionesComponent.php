<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CampanaNotificacionesComponent extends Component
{
    public $notificaciones;

    protected $listeners = [
        'echo:notificaciones-campana,IncidentesDeSeguridadEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,AuditoriaAnualEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,AccionCorrectivaEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,RegistroMejoraEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,RecursosEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,PoliticasSgiEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,AlcancesEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,RequisicionesEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,MatrizRequisitosEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,EntendimientoOrganizacionEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,DocumentoEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,TimesheetEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,CoursesEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,SolicitudVacacionesEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,SolicitudDayofEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,SolicitudPermisoEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,PlanImplementacionEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,EvaluacionEvent' => 'getTotalNotificaciones',
        'NotificationMarkedAsReadList' => 'getTotalNotificaciones',
    ];

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
