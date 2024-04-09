<?php

namespace App\Http\Livewire;

use App\Mail\CorreoRecordatorioEvDesempeno;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\EvaluacionDesempeno;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EvDesempenoDashboardEvaluacion extends Component
{
    public $id_evaluacion;
    public $evaluacion;

    public $areas;

    public $evaluadores_evaluado = [];
    public $totales_evaluado = [];

    public $chartData = [10, 20, 30, 40, 50]; // Example data

    protected $listeners = ['loadChartData'];

    public function mount($id_evaluacion)
    {
        $this->id_evaluacion = $id_evaluacion;
        $this->areas = Area::getIdNameAll();
    }

    public function render()
    {
        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);

        $this->evaluadores();
        $this->evaluadoTotales();
        $RPA = $this->resultadoPorArea();
        // $resultadoPorArea = ;

        $this->emit('renderAreas');

        return view('livewire.ev-desempeno-dashboard-evaluacion');
    }

    public function enviarRecordatorio()
    {
        dump($this->evaluacion->evaluados);
        foreach ($this->evaluacion->evaluados as $evaluado) {
            if ($evaluado->estatus_evaluado == false) {
                dd($evaluado);
                if ($this->evaluacion->activar_competencias) {
                    # code...
                    dd($evaluado->evaluadoresCompetencias);
                }

                if ($this->evaluacion->activar_objetivos) {
                    # code...
                    dd($evaluado->evaluadoresObjetivos);
                }
            }
            // dd($evaluado->empleado->email);
        }
    }

    public function cerrarEvaluacion()
    {
        $this->evaluacion->update(
            [
                'estatus' => 2,
            ]
        );
    }

    public function evaluadores()
    {
        $empleados = Empleado::getAllDataColumns();

        foreach ($this->evaluacion->evaluados as $evaluado) {
            foreach ($evaluado->nombres_evaluadores as $key => $id_evaluador) {
                $evaluador = $empleados->find($id_evaluador);

                $this->evaluadores_evaluado[$evaluado->id][] = [
                    'id' => $evaluador->id,
                    'nombre' => $evaluador->name,
                    // 'email' => $evaluador->email, //No necesario
                    'foto' => $evaluador->foto,
                ];
            }
        }
    }

    public function evaluadoTotales()
    {
        foreach ($this->evaluacion->evaluados as $evaluado) {
            $this->totales_evaluado[$evaluado->id] =
                [
                    'competencias' => $evaluado->calificaciones_competencias_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100),
                    'objetivos' => $evaluado->calificaciones_objetivos_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
                    'final' => $evaluado->calificaciones_competencias_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100) + $evaluado->calificaciones_objetivos_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
                ];
        }
    }

    public function resultadoPorArea()
    {
        $areas = Area::getIdNameAll();

        $ids_areas = $this->evaluacion->areas_evaluacion;

        foreach ($ids_areas as $key => $area_id) {
            $area = $areas->find($area_id);
            $nombres_grafica_area[] = $area->area;
        }
        // dd($nombres_grafica_area);
        return $nombres_grafica_area;
    }
}
