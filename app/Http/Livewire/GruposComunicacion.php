<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\RH\GruposEvaluado;
use Livewire\Component;

class GruposComunicacion extends Component
{
    protected $listeners = ['grupoEvaluadosSaved' => 'render'];

    public $evaluados_objetivo;

    public $by_manual;

    public $by_area;

    public $habilitarSelectManual = false;

    public $habilitarSelectAreas = false;

    public function render()
    {
        $grupos_evaluados = GruposEvaluado::getAll();
        $areas = Area::getAll();
        $empleados = Empleado::getaltaAll();

        return view('livewire.grupos-comunicacion', ['grupos_evaluados' => $grupos_evaluados, 'areas' => $areas, 'empleados' => $empleados]);
    }

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
}
