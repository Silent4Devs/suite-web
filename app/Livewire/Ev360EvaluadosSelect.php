<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\RH\GruposEvaluado;
use Livewire\Component;

class Ev360EvaluadosSelect extends Component
{
    protected $listeners = ['grupoEvaluadosSaved' => 'render'];

    public $evaluados_objetivo;

    public $habilitarSelectManual = false;

    public $habilitarSelectAreas = false;

    public function habilitarSelectAlternativo()
    {
        if ($this->evaluados_objetivo == 'manual') {
            $this->habilitarSelectManual = true;
            $this->habilitarSelectAreas = false;
        } elseif ($this->evaluados_objetivo == 'area') {
            $this->habilitarSelectAreas = true;
            $this->habilitarSelectManual = false;
        } else {
            $this->habilitarSelectManual = false;
            $this->habilitarSelectAreas = false;
        }
    }

    public function render()
    {
        $grupos_evaluados = GruposEvaluado::get();
        $empleados = Empleado::getaltaAll();
        $areas = Area::getAll();

        return view('livewire.ev360-evaluados-select', ['grupos_evaluados' => $grupos_evaluados, 'areas' => $areas, 'empleados' => $empleados]);
    }
}
