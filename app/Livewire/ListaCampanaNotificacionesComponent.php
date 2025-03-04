<?php

namespace App\Livewire;

use App\Models\User;
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
        'echo:notificaciones-campana,PoliticasSgiEvent' => 'render',
        'echo:notificaciones-campana,AlcancesEvent' => 'render',
        'echo:notificaciones-campana,MatrizRequisitosEvent' => 'render',
        'echo:notificaciones-campana,RequisicionesEvent' => 'render',
        'echo:notificaciones-campana,EntendimientoOrganizacionEvent' => 'render',
        'echo:notificaciones-campana,DocumentoEvent' => 'render',
        'echo:notificaciones-campana,TimesheetEvent' => 'render',
        'echo:notificaciones-campana,CoursesEvent' => 'render',
        'echo:notificaciones-campana,SolicitudVacacionesEvent' => 'render',
        'echo:notificaciones-campana,SolicitudDayofEvent' => 'render',
        'echo:notificaciones-campana,SolicitudPermisoEvent' => 'render',
        'echo:notificaciones-campana,PlanImplementacionEvent' => 'render',
        'echo:notificaciones-campana,EvaluacionEvent' => 'render',
        'echo:notificaciones-campana,RiesgosEvent' => 'render',
        'echo:notificaciones-campana,QuejasEvent' => 'render',
        'echo:notificaciones-campana,DenunciasEvent' => 'render',
        'echo:notificaciones-campana,MejorasEvent' => 'render',
        'echo:notificaciones-campana,SugerenciasEvent' => 'render',
        'echo:notificaciones-campana,MinutasEvent' => 'render',
        'echo:notificaciones-campana,PuestosEvent' => 'render',
        'echo:notificaciones-campana,TimesheetProyectoEvent' => 'render',
        'echo:notificaciones-campana,CatalogueCertificatesEvent' => 'render',
        'NotificationMarkedAsReadList' => 'render',
    ];

    public function mount($notificaciones_sin_leer)
    {
        $this->notificaciones_sin_leer = $notificaciones_sin_leer;
    }

    public function render()
    {
        $last_unread_notifications = User::getCurrentUser()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->latest()->take(5)->get();

        return view('livewire.lista-campana-notificaciones-component', ['last_unread_notifications' => $last_unread_notifications]);
    }
}
