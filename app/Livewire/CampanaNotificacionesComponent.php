<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CampanaNotificacionesComponent extends Component
{
    public $notificaciones;

    public $notificaciones_sin_leer;

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
        'echo:notificaciones-campana,RiesgosEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,QuejasEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,DenunciasEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,MejorasEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,SugerenciasEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,MinutasEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,PuestosEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,TimesheetProyectoEvent' => 'getTotalNotificaciones',
        'echo:notificaciones-campana,CatalogueCertificatesEvent' => 'getTotalNotificaciones',
        'NotificationMarkedAsReadList' => 'getTotalNotificaciones',
    ];

    public function render()
    {
        $this->updateNotifications();

        return view('livewire.campana-notificaciones-component');
    }

    public function getTotalNotificaciones()
    {
        $this->updateNotifications();
        $this->dispatch('campana-notificaciones');
    }

    private function updateNotifications()
    {
        // $user = Auth::user();
        $user = User::getCurrentUser();
        $this->notificaciones = $user->unreadNotifications()->latest()->take(5)->get();
        $this->notificaciones_sin_leer = $user->unreadNotifications()->select('data')->where('data', 'not like', '%"tipo_notificacion":"task"%')->count();
    }
}
