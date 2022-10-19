<?php

namespace App\Http\Livewire;

use App\Models\TaskKanbanPA;
use Livewire\Component;

class KanbanTarea extends Component
{
    public $tareas;
    public $empleadoID = 222;
    public $taskGroup;

    public function mount()
    {
        $this->getTasks();
    }

    public function getTasks()
    {
        $this->tareas = TaskKanbanPA::with('group')->whereHas('empleados', function ($q) {
            $q->where('empleados_id', $this->empleadoID);
        })->get();
    }

    public function taskGroupChange($taskId, $groupId)
    {
        TaskKanbanPA::find($taskId)->update([
            'group_kanban_p_a_s_id' => $groupId
        ]);
        $this->getTasks();
    }

    public function render()
    {
        return view('livewire.kanban-tarea');
    }
}
