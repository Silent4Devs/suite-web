<?php

namespace App\Http\Livewire;

use App\Models\GroupKanbanPA;
use App\Models\PlanAccionKanban;
use App\Models\TaskKanbanPA;
use Livewire\Component;

class KanbanLienzo extends Component
{
    public $initialProcess = [
        'Por Hacer',
        'En Curso',
        'Listo'
    ];

    protected $listeners = ['refreshPlanAccionK' => 'getGroups'];

    public $groups;
    public $planAccionId;
    public $planAccionModel;
    public $newGroupLabel;
    public $titleTask;
    public $onlyRead = false;


    public function mount($planAccionId, $onlyRead)
    {
        $this->getGroups();
        $this->planAccionId = $planAccionId;
        $this->onlyRead = $onlyRead;
        $this->planAccionModel = PlanAccionKanban::find($planAccionId);
    }

    public function render()
    {

        return view('livewire.kanban-lienzo');
    }

    public function updateGroupOrder($groupOrders)
    {
        foreach ($groupOrders as $group) {
            $group_temp = GroupKanbanPA::find($group['value']);
            $group_temp->update([
                'order' => $group['order']
            ]);
        }
        $this->getGroups();
    }
    public function updateTaskOrder($newOrders)
    {
        // dd($newOrders);
        foreach ($newOrders as $item) {
            $group_temp = GroupKanbanPA::find($item['value']);
            foreach ($item['items'] as $task) {
                $task_temp = TaskKanbanPA::where('id', $task['value'])->first();
                $task_temp->update([
                    'order' => $task['order'],
                    'group_kanban_p_a_s_id' => $group_temp->id
                ]);
            }
        }
        $this->getGroups();
    }

    public function addTask($groupId)
    {
        $this->validate([
            'titleTask' => 'required|max:255'
        ], [
            'titleTask.required' => 'Este campo es obligatorio',
            'titleTask.max' => 'Este campo acepta como máximo 255 carácteres',
        ]);
        TaskKanbanPA::create([
            'title' => $this->titleTask,
            'order' => $this->getOrder($groupId),
            'group_kanban_p_a_s_id' => $groupId
        ]);
        $this->getGroups();
        $this->titleTask = null;
    }

    public function editTask($taskId)
    {
        $this->emit('openModalKanbanPA', $taskId);
    }

    public function removeTask($taskId)
    {
        TaskKanbanPA::find($taskId)->delete();
        $this->getGroups();
    }

    public function getOrder($groupId)
    {
        if (!TaskKanbanPA::where('group_kanban_p_a_s_id', $groupId)->exists()) {
            return 1;
        } else {
            return TaskKanbanPA::where('group_kanban_p_a_s_id', $groupId)->pluck('order')->max() + 1;
        }
    }
    public function getOrderGroup($planAccionIdTemp)
    {
        if (!GroupKanbanPA::where('planes_accion_kanban_id', $planAccionIdTemp)->exists()) {
            return 1;
        } else {
            return GroupKanbanPA::where('planes_accion_kanban_id', $planAccionIdTemp)->pluck('order')->max() + 1;
        }
    }

    public function getGroups()
    {
        $this->groups = PlanAccionKanban::find($this->planAccionId)->groups;
    }

    public function addGroup()
    {
        $this->validate([
            'newGroupLabel' => 'required|max:255'
        ], [
            'newGroupLabel.required' => 'Este campo es obligatorio',
            'newGroupLabel.max' => 'Este campo acepta como máximo 255 carácteres',
        ]);
        GroupKanbanPA::create([
            'label' => $this->newGroupLabel,
            'order' => $this->getOrderGroup($this->planAccionId),
            'planes_accion_kanban_id' => $this->planAccionId
        ]);
        $this->getGroups();
        $this->newGroupLabel = null;
    }

    public function removeGroup($groupId)
    {
        GroupKanbanPA::find($groupId)->delete();
        $this->getGroups();
    }
}
