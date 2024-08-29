<?php

namespace App\Http\Livewire;

use App\Models\PlanImplementacion;
use App\Models\User;
use Livewire\Component;

class PlanImplementacionCreate extends Component
{
    public $parent;

    public $norma;

    public $modulo_origen;

    public $objetivo;

    public $referencia;

    public $matriz_id = '';

    protected $rules = [
        'parent' => 'required|string',
        'norma' => 'required|string',
        'modulo_origen' => 'required|string',
        'objetivo' => 'required|string',
    ];

    protected $mesages = [
        'parent.required' => 'Debes de definir un nombre para el Plan de Trabajo',
        'norma.required' => 'Debes de definir una norma para el Plan de Trabajo',
        'modulo_origen.required' => 'Debes de definir un módulo de origen para el Plan de Trabajo',
        'objetivo.required' => 'Debes de definir un objetivo para el Plan de Trabajo',
    ];

    public function mount($modulo_origen)
    {
        $this->modulo_origen = $modulo_origen;
    }

    public function save()
    {
        $this->validate();
        // $this->validate([
        //     'parent' => 'required|string',
        //     'norma' => 'required|string',
        //     'modulo_origen' => 'required|string',
        //     'objetivo' => 'required|string',
        // ], [
        //     'parent.required' => 'Debes de definir un nombre para el Plan de Trabajo',
        //     'norma.required' => 'Debes de definir una norma para el Plan de Trabajo',
        //     'modulo_origen.required' => 'Debes de definir un módulo de origen para el Plan de Trabajo',
        //     'objetivo.required' => 'Debes de definir un objetivo para el Plan de Trabajo',
        // ]);

        PlanImplementacion::create([ // Necesario se carga inicialmente el Diagrama Universal de Gantt
            'tasks' => [],
            'canAdd' => true,
            'canWrite' => true,
            'canWriteOnParent' => true,
            'changesReasonWhy' => false,
            'selectedRow' => 0,
            'zoom' => '3d',
            'parent' => $this->parent,
            'norma' => $this->norma,
            'modulo_origen' => $this->modulo_origen,
            'objetivo' => $this->objetivo,
            'elaboro_id' => User::getCurrentUser()->empleado->id,
        ]);
        $this->emit('planStore');
        $this->emit('render-select');
    }

    public function render()
    {
        return view('livewire.plan-implementacion-create');
    }
}
