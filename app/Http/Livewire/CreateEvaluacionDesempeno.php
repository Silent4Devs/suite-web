<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Empleado;
use Livewire\Component;

class CreateEvaluacionDesempeno extends Component
{
    public $paso = 1;

    //Variables primer paso
    public $nombre_evaluacion = null;
    public $descripcion_evaluacion = null;
    public $activar_objetivos = false;
    public $porcentaje_objetivos = 50;
    public $activar_competencias = false;
    public $porcentaje_competencias = 50;

    //Variables segundo paso
    public $mensual = false;
    public $bimestral = false;
    public $trimestral = false;
    public $semestral = false;
    public $anual = false;
    public $abierta = false;
    //Arreglo para recopilar periodos
    public $arreglo_periodos = [];

    //Variables paso 3
    public $select_evaluados = 'toda';
    public $areas;
    public $empleados;
    public $evaluados_areas;
    public $evaluados_manual = [];

    //Variables paso 4
    public $evaluados;
    public $array_evaluados;
    public $array_evaluadores;
    public $evaluadores = [];

    public function mount()
    {
        // dd($a, $e);
        // $this->areas = $a;
        // $this->empleados = $e;

        // dd(
        //     $this->areas,
        //     $this->empleados
        // );
    }

    public function render()
    {
        return view('livewire.create-evaluacion-desempeno');
    }

    public function retroceder()
    {
        $this->paso--;
    }

    public function primerPaso()
    {
        $datosPaso1 = [
            'nombre' => $this->nombre_evaluacion,
            'descripcion' => $this->descripcion_evaluacion,
            'activar_objetivos' => $this->activar_objetivos,
            'porcentaje_objetivos' => $this->porcentaje_objetivos,
            'activar_competencias' => $this->activar_competencias,
            'porcentaje_competencias' => $this->porcentaje_competencias,
        ];

        $this->paso++;
    }

    public function segundoPaso()
    {
        // dd('2', $this->arreglo_periodos);
        $datosPaso2 = [];

        foreach ($this->arreglo_periodos as $key => $ap) {
            $datosPaso2[] =
                [
                    'nombre_evaluacion' => $ap['nombre_evaluacion'],
                    'fecha_inicio' => $ap['fecha_inicio'],
                    'fecha_fin' => $ap['fecha_fin'],
                    'habilitar' => $ap['habilitar']
                ];
        }
        // dd('datos', $datosPaso2);
        $this->paso++;
    }

    public function tercerPaso()
    {
        $evld = [];
        switch ($this->select_evaluados) {
            case 'toda':
                $ev_query = Empleado::getIDaltaAll();
                $evld = $ev_query->pluck('id');
                break;

            case 'areas':
                $ev_query = Area::with('totalIDEmpleados')->find($this->evaluados_areas);
                $evld = $ev_query->totalIDEmpleados->pluck('id');
                dd($evld);
                break;

            case 'manualmente':
                // $this->empleados = Empleado::getIDaltaAll()->sortBy('name');
                // $this->areas = null;
                // $this->select_evaluados = $valor;

                // dd($this->empleados);
                break;

            case 'grupos':
                // $this->empleados = Empleado::getIDaltaAll();
                break;
        }
        // dd($ev);
        // dd($this->evaluados = $evld);
        $this->asignarEvaluadoresAEvaluados($evld);

        $this->paso++;
    }

    public function seleccionPeriodo($periodo, $valor)
    {
        // dd($periodo, $valor);
        $this->arreglo_periodos = [];
        switch ($periodo) {
            case 'mensual':
                $this->mensual = $valor;
                $this->bimestral = false;
                $this->trimestral = false;
                $this->semestral = false;
                $this->anual = false;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 12; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                // dd($this->arreglo_periodos[0]);
                break;

            case 'bimestral':
                $this->mensual = false;
                $this->bimestral = $valor;
                $this->trimestral = false;
                $this->semestral = false;
                $this->anual = false;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 6; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            case 'trimestral':
                $this->mensual = false;
                $this->bimestral = false;
                $this->trimestral = $valor;
                $this->semestral = false;
                $this->anual = false;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 4; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            case 'semestral':
                $this->mensual = false;
                $this->bimestral = false;
                $this->trimestral = false;
                $this->semestral = $valor;
                $this->anual = false;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 2; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            case 'anual':
                $this->mensual = false;
                $this->bimestral = false;
                $this->trimestral = false;
                $this->semestral = false;
                $this->anual = $valor;
                $this->abierta = false;

                if ($valor) {
                    for ($i = 1; $i <= 1; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            case 'abierta':
                $this->mensual = false;
                $this->bimestral = false;
                $this->trimestral = false;
                $this->semestral = false;
                $this->anual = false;
                $this->abierta = $valor;

                if ($valor) {
                    for ($i = 1; $i <= 1; $i++) {
                        $this->arreglo_periodos[] = [
                            'nombre_evaluacion' => null,
                            'fecha_inicio' => null,
                            'fecha_fin' => null,
                            'habilitar' => false
                        ];
                    }
                }
                //dd($this->arreglo_periodos);
                break;

            default:
                # code...
                //dd($this->arreglo_periodos);
                break;
        }
    }

    public function seleccionarEvaluados($valor)
    {
        // dd($valor);
        switch ($valor) {
            case 'toda':
                $this->select_evaluados = $valor;
                $this->areas = null;
                $this->empleados = null;
                break;

            case 'areas':
                $this->areas = Area::getIdNameAll()->sortBy('area');
                $this->empleados = null;
                $this->select_evaluados = $valor;
                // dd($this->areas);
                break;

            case 'manualmente':
                $this->empleados = Empleado::getIDaltaAll()->sortBy('name');
                $this->areas = null;
                $this->select_evaluados = $valor;

                // dd($this->empleados);
                break;

            case 'grupos':
                // $this->empleados = Empleado::getIDaltaAll();
                break;
        }
    }

    public function asignarEvaluadoresAEvaluados($evaluados)
    {
        $emps = Empleado::select(
            'id',
            'name',
            'area_id',
            'supervisor_id',
            'puesto_id',
        )->with(['objetivos', 'children:id,name', 'supervisor:id,name', 'area:id,area', 'puestoRelacionado:id,puesto'])->where('estatus', 'alta')->whereNull('deleted_at')->get();

        foreach ($evaluados as $id_evaluado) {
            $eva = $emps->find($id_evaluado);
            $this->array_evaluados[] =
                [
                    'id' => $eva->id,
                    'name' => $eva->name,
                    'area' => $eva->area->area,
                ];
            // dd($eva);
        }

        foreach ($emps as $emp) {
            $this->array_evaluadores[] =                 [
                'id' => $emp->id,
                'name' => $emp->name,
                // 'area' => $emp->area->area,
            ];
        }
        // dd($emps);
    }
}
