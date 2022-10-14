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
    // public $groups = '
    //     {
    //         "groups":[
    //             {
    //                 "id":1,
    //                 "label":"Por Hacer",
    //                 "tasks":[
    //                     {
    //                         "id":1,
    //                         "title":"demo1"
    //                     },
    //                     {
    //                         "id":2,
    //                         "title":"demo2"
    //                     },
    //                     {
    //                         "id":3,
    //                         "title":"demo3"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "id":2,
    //                 "label":"En Curso",
    //                 "tasks":[]
    //             },
    //             {
    //                 "id":3,
    //                 "label":"Listo",
    //                 "tasks":[
    //                     {
    //                         "id":1,
    //                         "title":"demo1"
    //                     },
    //                     {
    //                         "id":2,
    //                         "title":"demo2"
    //                     },
    //                     {
    //                         "id":3,
    //                         "title":"demo3"
    //                     }
    //                 ]
    //             }
    //         ]
    //     }    
    // ';

    public $groups;
    public $planAccionId;
    public $newGroupLabel;


    public function mount($planAccionId)
    {
        $this->getGroups();
        $this->planAccionId = $planAccionId;
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

    public function addTask($groupId, $title)
    {
        TaskKanbanPA::create([
            'title' => $title,
            'order' => $this->getOrder($groupId),
            'group_kanban_p_a_s_id' => $groupId
        ]);
        $this->getGroups();
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
        GroupKanbanPA::create([
            'label' => $this->newGroupLabel,
            'order' => $this->getOrderGroup($this->planAccionId),
            'planes_accion_kanban_id' => $this->planAccionId
        ]);
        $this->getGroups();
    }

    public function removeGroup($groupId)
    {
        GroupKanbanPA::find($groupId)->delete();
        $this->getGroups();
    }
}
