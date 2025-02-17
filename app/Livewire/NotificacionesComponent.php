<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class NotificacionesComponent extends Component
{
    use WithPagination;

    public $view = 'no-leidas';

    private $lista_notificaciones;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'NotificationMarkedAsReadList' => 'unreadNotifications',
        'echo:notificaciones-campana,IncidentesDeSeguridadEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,AuditoriaAnualEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,AccionCorrectivaEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,RegistroMejoraEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,RecursosEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,PoliticasSgiEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,AlcancesEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,RequisicionesEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,MatrizRequisitosEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,EntendimientoOrganizacionEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,DocumentoEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,TimesheetEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,CoursesEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,SolicitudVacacionesEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,SolicitudDayofEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,SolicitudPermisoEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,PlanImplementacionEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,EvaluacionEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,RiesgosEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,QuejasEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,DenunciasEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,MejorasEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,SugerenciasEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,MinutasEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,PuestosEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,TimesheetProyectoEvent' => 'unreadNotifications',
        'echo:notificaciones-campana,CatalogueCertificatesEvent' => 'unreadNotifications',
    ];

    public function getQueryString()
    {
        return [];
    }

    public function mount()
    {
        $this->getUnreadNotifications();
    }

    public function render()
    {
        if ($this->view == 'no-leidas') {
            $this->getUnreadNotifications();
        } else {
            $this->getReadedNotifications();
        }

        return view('livewire.notificaciones-component', [
            'lista_notificaciones' => $this->lista_notificaciones,
        ]);
    }

    public function unreadNotifications()
    {
        $this->view = 'no-leidas';
        $this->resetPage();

        // $this->getUnreadNotifications();
        return response()->noContent();
    }

    public function notificationsReaded()
    {
        $this->view = 'leidas';
        $this->resetPage();

        // $this->getReadedNotifications();
        return response()->noContent();
    }

    public function getUnreadNotifications()
    {
        $this->lista_notificaciones = User::getCurrentUser()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->orderByDesc('id')
            ->cursorPaginate(12);

        return response()->noContent();
    }

    public function getReadedNotifications()
    {
        $this->lista_notificaciones = User::getCurrentUser()->readNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->orderByDesc('id')
            ->cursorPaginate(12);

        return response()->noContent();
    }

    public function markAsRead(string $notificationId)
    {
        User::getCurrentUser()->unreadNotifications
            ->when($notificationId, function ($query) use ($notificationId) {
                return $query->where('id', $notificationId)->markAsRead();
            });
        $this->dispatch('NotificationMarkedAsReadList');

        return response()->noContent();
    }

    public function deleteNotification(string $notificationId)
    {
        $notification = User::getCurrentUser()->notifications()->find($notificationId);

        if ($notification) {
            $notification->delete();
            $this->dispatch('NotificationDeleted'); // Notifica que una notificación ha sido eliminada
            $this->getUnreadNotifications(); // Actualiza la lista de notificaciones
        }

        return response()->noContent();
    }

    public function markAllAsRead()
    {
        $notificaciones_campana = User::getCurrentUser()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->get();
        foreach ($notificaciones_campana as $notificacion_campana) {
            $notificacion_campana->markAsRead();
        }
        $this->dispatch('NotificationMarkedAsReadList');

        return response()->noContent();
    }
}
