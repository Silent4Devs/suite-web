<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

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

        //$this->getUnreadNotifications();
        return response()->noContent();
    }

    public function notificationsReaded()
    {
        $this->view = 'leidas';
        $this->resetPage();

        //$this->getReadedNotifications();
        return response()->noContent();
    }

    public function getUnreadNotifications()
    {
        $this->lista_notificaciones = Auth::user()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->fastPaginate(10);

        return response()->noContent();
    }

    public function getReadedNotifications()
    {
        $this->lista_notificaciones = Auth::user()->readNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->fastPaginate(10);

        return response()->noContent();
    }

    public function markAsRead(string $notificationId)
    {
        User::getCurrentUser()->unreadNotifications
            ->when($notificationId, function ($query) use ($notificationId) {
                return $query->where('id', $notificationId)->markAsRead();
            });
        $this->emit('NotificationMarkedAsReadList');

        return response()->noContent();
    }

    public function markAllAsRead()
    {
        $notificaciones_campana = Auth::user()->unreadNotifications()->where('data', 'not like', '%"tipo_notificacion":"task"%')->get();
        foreach ($notificaciones_campana as $notificacion_campana) {
            $notificacion_campana->markAsRead();
        }
        $this->emit('NotificationMarkedAsReadList');

        return response()->noContent();
    }
}
