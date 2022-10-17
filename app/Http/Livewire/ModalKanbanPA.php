<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\PlanAccionKanban;
use App\Models\TaskKanbanPA;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ModalKanbanPA extends Component
{
    use LivewireAlert;

    protected $listeners = ['openModalKanbanPA'];
    public $task;
    public $title;
    public $group_kanban_p_a_s_id;
    public $groups;
    public $empleados;
    public $planAccionId;
    public $responsables = [];
    public $responsables_seleccionados = [];
    public $description = null;
    public $aceptacion = null;
    public $fecha_inicio = null;
    public $fecha_fin = null;
    public $duracion = null;

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount($planAccionId)
    {
        $this->planAccionId = $planAccionId;
        $this->getGroups();
        $this->getEmpleados();
    }

    public function getGroups()
    {
        $this->groups = PlanAccionKanban::find($this->planAccionId)->groups;
    }
    public function getEmpleados()
    {
        $this->empleados = Empleado::select('id', 'name', 'foto')->alta()->get();
    }

    public function openModalKanbanPA($taskId)
    {
        $task = TaskKanbanPA::with('empleados')->find($taskId);
        $this->responsables_seleccionados = $task->empleados->pluck('id')->toArray();
        $this->task = $task;
        $this->title = $task->title;
        $this->group_kanban_p_a_s_id = $task->group_kanban_p_a_s_id;

        $this->emit('openModalK', $task, $this->responsables_seleccionados);
    }

    public function save()
    {
        $this->task->update([
            'title' => $this->title != null ? $this->title : $this->task->title,
            'description' => $this->description != null ? $this->description : $this->task->description,
            'aceptacion' => $this->aceptacion != null ? $this->aceptacion : $this->task->aceptacion,
            'fecha_inicio' => $this->fecha_inicio != null ? $this->fecha_inicio : $this->task->fecha_inicio,
            'fecha_fin' => $this->fecha_fin != null ? $this->fecha_fin : $this->task->fecha_fin,
            'duracion' => $this->duracion != null ? $this->duracion : $this->task->duracion,
            'group_kanban_p_a_s_id' => $this->group_kanban_p_a_s_id != null ? $this->group_kanban_p_a_s_id : $this->task->group_kanban_p_a_s_id
        ]);
        if ($this->responsables != null) {
            $this->task->empleados()->sync($this->responsables);
        }
        $this->alert('success', '¡Actualizado con éxito!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->emit('refreshPlanAccionK');
        $this->emit('closeModalK');
    }

    public function render()
    {
        return view('livewire.modal-kanban-p-a');
    }
}
