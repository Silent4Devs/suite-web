<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Admin\RH\EV360EvaluacionesController;
use App\Models\Empleado;
use App\Models\RH\Evaluacion;
use Livewire\Component;

class ConsultaDeEvaluciones extends Component
{
    public $evaluacion;
    public $evaluado;
    public $evaluador;
    public $calificaciones_autoevaluacion_competencias;
    public $calificaciones_autoevaluacion_competencias_compare_first;
    public $calificaciones_autoevaluacion_competencias_compare;
    public $calificaciones_jefe_competencias;
    public $calificaciones_equipo_competencias;
    public $calificaciones_area_competencias;
    public $calificaciones_meta_competencias;
    public $competencias_lista_nombre;
    public $competencias_lista_nombre_max;
    public $calificaciones;
    public $calificaciones_compare_first;
    public $calificaciones_compare;
    public $informacion_obtenida;
    public $informacion_obtenida_compare_first;
    public $informacion_obtenida_compare;
    public $equipo;
    public $evaluacion1;
    public $evaluacion2;
    public $showCompare = false;

    public function mount($evaluacion, $evaluado, $equipo, $evaluador = null)
    {
        $this->evaluacion = $evaluacion;
        $this->evaluado = $evaluado;
        $this->evaluador = $evaluador;
        $this->equipo = $equipo;
    }

    public function render()
    {
        $evaluacionController = new EV360EvaluacionesController;
        $ev360ResumenTabla = new Ev360ResumenTabla();
        $this->informacion_obtenida = $ev360ResumenTabla->obtenerInformacionDeLaConsultaPorEvaluado($this->evaluacion, $this->evaluado);
        $this->calificaciones = $evaluacionController->desglosarCalificaciones($this->informacion_obtenida);
        $this->calificaciones_autoevaluacion_competencias = $this->calificaciones['calificaciones_autoevaluacion_competencias'];
        $this->calificaciones_jefe_competencias = $this->calificaciones['calificaciones_jefe_competencias'];
        $this->calificaciones_equipo_competencias = $this->calificaciones['calificaciones_equipo_competencias'];
        $this->calificaciones_area_competencias = $this->calificaciones['calificaciones_area_competencias'];
        $this->calificaciones_meta_competencias = $this->calificaciones['calificaciones_meta_competencias'];
        $this->competencias_lista_nombre = $this->calificaciones['competencias_lista_nombre'];
        $evaluaciones = Evaluacion::getAll();
        $this->emit('renderCharts');

        if ($this->equipo) {
            $jefe = Empleado::select('id', 'name')->with('children')->find($this->evaluador);
            $equipo_a_cargo = $evaluacionController->obtenerEquipoACargo($jefe->children);
            $equipo_a_cargo = Empleado::select('id', 'name')->find($equipo_a_cargo);

            return view('livewire.consulta-de-evaluciones', [
                'evaluaciones' => $evaluaciones,
                'empleados' => $equipo_a_cargo,
            ]);
        } else {
            return view('livewire.consulta-de-evaluciones', [
                'evaluaciones' => $evaluaciones,
            ]);
        }
    }

    public function compararEvaluaciones()
    {
        $this->validate([
            'evaluacion1' => 'required',
            'evaluacion2' => 'required',
        ]);
        // dd($this->evaluacion1);
        $ev360ResumenTabla = new Ev360ResumenTabla();
        $evaluacionController = new EV360EvaluacionesController;
        $this->informacion_obtenida_compare_first = $ev360ResumenTabla->obtenerInformacionDeLaConsultaPorEvaluado($this->evaluacion1, $this->evaluado);
        $this->informacion_obtenida_compare = $ev360ResumenTabla->obtenerInformacionDeLaConsultaPorEvaluado($this->evaluacion2, $this->evaluado);

        $this->calificaciones_compare_first = $evaluacionController->desglosarCalificaciones($this->informacion_obtenida_compare_first);
        $this->calificaciones_autoevaluacion_competencias_compare_first = $this->calificaciones_compare_first['calificaciones_autoevaluacion_competencias'];

        $this->calificaciones_compare = $evaluacionController->desglosarCalificaciones($this->informacion_obtenida_compare);
        $this->calificaciones_autoevaluacion_competencias_compare = $this->calificaciones_compare['calificaciones_autoevaluacion_competencias'];

        $this->competencias_lista_nombre_max = $this->calificaciones_compare_first['competencias_lista_nombre'];
        $this->showCompare = true;

        // $this->emit('comparar');
    }

    public function resetComparar()
    {
        $this->showCompare = false;
        $this->evaluacion1 = null;
        $this->evaluacion2 = null;
        $this->informacion_obtenida_compare_first = null;
        $this->informacion_obtenida_compare = null;

        $this->calificaciones_compare_first = null;
        $this->calificaciones_autoevaluacion_competencias_compare_first = null;

        $this->calificaciones_compare = null;
        $this->calificaciones_autoevaluacion_competencias_compare = null;

        $this->competencias_lista_nombre_max = null;
    }
}
