<?php

namespace App\Livewire;

use App\Http\Controllers\Admin\RH\EV360EvaluacionesController;
use App\Models\Empleado;
use App\Models\RH\Evaluacion;
use Livewire\Component;

class CompararEvaluaciones extends Component
{
    public $evaluador;

    public $calificaciones_autoevaluacion_competencias_compare_first;

    public $calificaciones_autoevaluacion_competencias_compare;

    public $competencias_lista_nombre_max;

    public $calificaciones_compare_first;

    public $calificaciones_compare;

    public $informacion_obtenida_compare_first;

    public $informacion_obtenida_compare;

    public $evaluacion1;

    public $evaluacion2;

    public function mount($evaluacion, $evaluador)
    {
        $this->evaluacion = $evaluacion;
        $this->evaluador = $evaluador;
    }

    public function render()
    {
        $evaluacionController = new EV360EvaluacionesController;
        $evaluaciones = Evaluacion::getAll();
        $jefe = Empleado::select('id', 'name')->with('children')->find($this->evaluador);
        $equipo_a_cargo = $evaluacionController->obtenerEquipoACargo($jefe->children);
        $equipo_a_cargo = Empleado::select('id', 'name')->find($equipo_a_cargo);

        return view('livewire.comparar-evaluaciones', [
            'evaluaciones' => $evaluaciones,
            'empleados' => $equipo_a_cargo,
        ]);
    }

    public function compararEvaluaciones($evaluado)
    {
        $evaluacionController = new EV360EvaluacionesController;
        $this->informacion_obtenida_compare_first = $evaluacionController->obtenerInformacionDeLaConsultaPorEvaluado($this->evaluacion1, $evaluado);
        $this->informacion_obtenida_compare = $evaluacionController->obtenerInformacionDeLaConsultaPorEvaluado($this->evaluacion2, $evaluado);

        $this->calificaciones_compare_first = $evaluacionController->desglosarCalificaciones($this->informacion_obtenida_compare_first);
        $this->calificaciones_autoevaluacion_competencias_compare_first = $this->calificaciones_compare_first['calificaciones_autoevaluacion_competencias'];

        $this->calificaciones_compare = $evaluacionController->desglosarCalificaciones($this->informacion_obtenida_compare);
        $this->calificaciones_autoevaluacion_competencias_compare = $this->calificaciones_compare['calificaciones_autoevaluacion_competencias'];

        $this->competencias_lista_nombre_max = $this->calificaciones_compare_first['competencias_lista_nombre'];
    }
}
