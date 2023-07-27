<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TareasComponent extends Component
{
    use WithPagination;

    public $view = 'no-leidas';

    private $lista_tareas;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'TaskMarkedAsReadList' => 'unreadTasks',
        'render-task-list' => 'unreadTasks',
    ];

    public function getQueryString()
    {
        return [];
    }

    public function mount()
    {
        $this->getUnreadTasks();
    }

    public function render()
    {
        if ($this->view == 'no-leidas') {
            $this->getUnreadTasks();
        } else {
            $this->getReadedTasks();
        }

        return view('livewire.tareas-component', [
            'lista_tareas' => $this->lista_tareas,
        ]);
    }

    public function unreadTasks()
    {
        $this->view = 'no-leidas';
        //$this->getUnreadTasks();
        return response()->noContent();
    }

    public function tasksReaded()
    {
        $this->view = 'leidas';
        //$this->getReadedTasks();
        return response()->noContent();
    }

    public function getUnreadTasks()
    {
        $this->lista_tareas = Auth::user()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->paginate(10);

        return response()->noContent();
    }

    public function getReadedTasks()
    {
        $this->lista_tareas = Auth::user()->readNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->paginate(10);

        return response()->noContent();
    }

    public function markTaskAsRead(string $notificationId)
    {
        auth()->user()->unreadNotifications
            ->when($notificationId, function ($query) use ($notificationId) {
                return $query->where('id', $notificationId)->markAsRead();
            });
        $this->emit('TaskMarkedAsReadList');

        return response()->noContent();
    }

    public function markAllTasksAsRead()
    {
        $notificaciones_campana = Auth::user()->unreadNotifications()->where('data', 'like', '%"tipo_notificacion":"task"%')->get();
        foreach ($notificaciones_campana as $notificacion_campana) {
            $notificacion_campana->markAsRead();
        }
        $this->emit('TaskMarkedAsReadList');

        return response()->noContent();
    }
}
