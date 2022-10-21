<?php

namespace App\Http\Livewire;

use App\Models\GroupKanbanPA;
use App\Models\Norma;
use App\Models\PlanAccionKanban;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PlanAccionKanbanForm extends Component
{
    use LivewireAlert;

    public $title;
    public $normas;
    public $normasVinculadas;
    public $origen;
    public $descripcion;
    public $requireRedirect;
    public $edit;
    public $planAccionKanban;

    public function mount($planAccionKanbanId, $origen, $requireRedirect, $edit)
    {
        $this->normas = Norma::get();
        $this->origen = $origen;
        if ($planAccionKanbanId) {
            $this->planAccionKanban = PlanAccionKanban::find($planAccionKanbanId);
        } else {
            $this->planAccionKanban = new PlanAccionKanban();
        }
        $this->descripcion = $this->planAccionKanban->descripcion;
        $this->title = $this->planAccionKanban->title;
        $this->normasVinculadas = $this->planAccionKanban->normas->pluck('id')->toArray();
        $this->edit = $edit;
        $this->requireRedirect = $requireRedirect;
    }

    public function render()
    {
        return view('livewire.plan-accion-kanban-form');
    }

    public function save()
    {
        $planAccion = PlanAccionKanban::create([
            'title' => $this->title,
            'origen' => $this->origen,
            'descripcion' => $this->descripcion,
            'estatus' => 'En Proceso',
        ]);

        $planAccion->normas()->sync($this->normasVinculadas);
        //Default Groups
        GroupKanbanPA::create([
            'label' => 'Por Hacer',
            'planes_accion_kanban_id' => $planAccion->id,
            'order' => '1',
            'by_system' => true
        ]);
        GroupKanbanPA::create([
            'label' => 'En Curso',
            'planes_accion_kanban_id' => $planAccion->id,
            'order' => '2',
            'by_system' => true
        ]);
        GroupKanbanPA::create([
            'label' => 'Listo',
            'planes_accion_kanban_id' => $planAccion->id,
            'order' => '3',
            'by_system' => true
        ]);
        $this->alert('success', 'Plan de Acción creado con éxito', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        if ($this->requireRedirect) {
            return redirect()->route('admin.kanban-plan-accion.show', $planAccion->id);
        }
    }

    public function update()
    {
        $this->planAccionKanban->update([
            'title' => $this->title,
            'origen' => $this->origen,
            'descripcion' => $this->descripcion,
            'estatus' => 'En Proceso',
        ]);
        $this->planAccionKanban->normas()->sync($this->normasVinculadas);
        $this->alert('success', 'Plan de Acción editado con éxito', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        if ($this->requireRedirect) {
            return redirect()->route('admin.kanban-plan-accion.show', $this->planAccionKanban->id);
        }
    }
}
