<?php

namespace App\Http\Livewire;

use App\Models\GroupKanbanPA;
use App\Models\PlanAccionKanban;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PlanAccionKanbanForm extends Component
{
    use LivewireAlert;

    public $title;

    public function render()
    {
        return view('livewire.plan-accion-kanban-form');
    }

    public function save()
    {
        $planAccion = PlanAccionKanban::create([
            'title' => $this->title,
        ]);

        //Default Groups
        GroupKanbanPA::create([
            'label' => 'Por Hacer',
            'planes_accion_kanban_id' => $planAccion->id,
            'order' => '1'
        ]);
        GroupKanbanPA::create([
            'label' => 'En Curso',
            'planes_accion_kanban_id' => $planAccion->id,
            'order' => '2'
        ]);
        GroupKanbanPA::create([
            'label' => 'Listo',
            'planes_accion_kanban_id' => $planAccion->id,
            'order' => '3'
        ]);
        $this->alert('success', 'Creado!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    }
}
