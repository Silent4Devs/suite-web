<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\PeriodoCargaObjetivos;
use App\Models\RH\Objetivo;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CargarObjetivosArea extends Component
{
    use LivewireAlert;

    public $empleados;

    public $area = null;

    public $colaboradores = null;

    public $total_colaboradores = 0;

    public $total_con_objetivos = 0;

    public $total_sin_objetivos = 0;

    public $total_obj_pend = 0;

    public $select_colaborador = 0;

    public $fecha_inicio = null;

    public $fecha_fin = null;

    public $periodo_habilitado = null;

    public $emp;

    public function mount($id_area)
    {
        $this->area = Area::where('id', $id_area)->first();
        $this->emp = User::getCurrentUser()->empleado;

        // $this->colaboradores = Empleado::getaltaAllObjetivosGenerales()->where('area_id', $this->area->id)->sortBy('name');
        $this->colaboradores = $this->emp->subordinados;
        // dd($this->emp->subordinados);
        $periodo = PeriodoCargaObjetivos::first();
        $this->fecha_inicio = $periodo->fecha_inicio ?? null;
        $this->fecha_fin = $periodo->fecha_fin ?? null;
        $this->periodo_habilitado = $periodo->habilitado ?? null;
    }

    public function render()
    {
        // $this->empleados = Empleado::getaltaAllObjetivosGenerales()->where('area_id', $this->area->id)->sortBy('name');
        $this->empleados = $this->emp->subordinados;
        $this->cuentasCero();

        if ($this->select_colaborador != 0) {
            $this->empleados = $this->empleados->where('id', $this->select_colaborador)->sortBy('name');
            $this->cuentasCero();
        }

        $this->total_colaboradores = $this->empleados->count();

        foreach ($this->empleados as $emp) {
            if (count($emp->objetivos) > 0) {
                $this->total_con_objetivos++;

                foreach ($emp->objetivos as $emp_obj) {
                    if (isset($emp_obj->objetivo->esta_aprobado)) {
                        if ($emp_obj->objetivo->esta_aprobado == Objetivo::SIN_DEFINIR) {
                            $this->total_obj_pend++;
                            break;
                        }
                    }
                }
            } else {
                $this->total_sin_objetivos++;
            }
        }

        return view('livewire.cargar-objetivos-area');
    }

    public function cuentasCero()
    {
        $this->total_colaboradores = 0;
        $this->total_con_objetivos = 0;
        $this->total_sin_objetivos = 0;
        $this->total_obj_pend = 0;
    }
}
