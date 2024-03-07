<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\PerfilEmpleado;
use App\Models\PeriodoCargaObjetivos;
use App\Models\Puesto;
use App\Models\RH\Objetivo;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CargaObjetivos extends Component
{
    use LivewireAlert;

    public $empleados;
    public $areas;
    public $puestos;
    public $perfiles;

    public $total_colaboradores = 0;
    public $total_con_objetivos = 0;
    public $total_sin_objetivos = 0;
    public $total_obj_pend = 0;

    public $select_area = 0;
    public $select_puesto = 0;
    public $select_perfil = 0;

    public $fecha_inicio = null;
    public $fecha_fin = null;
    public $periodo_habilitado = null;

    public function mount()
    {
        $this->areas = Area::getAll()->sortBy('area');
        $this->puestos = Puesto::getAll()->sortBy('puesto');
        $this->perfiles = PerfilEmpleado::getAll()->sortBy('nombre');

        $periodo = PeriodoCargaObjetivos::first();
        $this->fecha_inicio = $periodo->fecha_inicio ?? null;
        $this->fecha_fin = $periodo->fecha_fin ?? null;
        $this->periodo_habilitado = $periodo->habilitado ?? null;
    }

    public function render()
    {
        $this->empleados = Empleado::getaltaAllWithAreaObjetivoPerfil()->sortBy('name');

        if ($this->select_area != 0) {
            $this->empleados = $this->empleados->where('area_id', $this->select_area)->sortBy('name');
            $this->total_colaboradores = 0;
            $this->total_con_objetivos = 0;
            $this->total_sin_objetivos = 0;
            $this->total_obj_pend = 0;
        }

        if ($this->select_puesto != 0) {
            $this->empleados = $this->empleados->where('puesto_id', $this->select_puesto)->sortBy('name');
            $this->total_colaboradores = 0;
            $this->total_con_objetivos = 0;
            $this->total_sin_objetivos = 0;
            $this->total_obj_pend = 0;
        }

        if ($this->select_perfil != 0) {
            $this->empleados = $this->empleados->where('perfil_empleado_id', $this->select_perfil)->sortBy('name');
            $this->total_colaboradores = 0;
            $this->total_con_objetivos = 0;
            $this->total_sin_objetivos = 0;
            $this->total_obj_pend = 0;
        }

        $this->total_colaboradores = $this->empleados->count();

        foreach ($this->empleados as $emp) {
            if (count($emp->objetivos) > 0) {
                $this->total_con_objetivos++;

                foreach ($emp->objetivos as $emp_obj) {
                    if ($emp_obj->objetivo->esta_aprobado == Objetivo::SIN_DEFINIR) {
                        $this->total_obj_pend++;
                        break;
                    }
                }
            } else {
                $this->total_sin_objetivos++;
            }
        }

        return view('livewire.carga-objetivos');
    }

    public function habilitarCargaObjetivos($valor)
    {
        if ($valor) {
            if (!empty($this->fecha_inicio) && !empty($this->fecha_fin)) {
                if ($this->fecha_inicio < $this->fecha_fin) {

                    PeriodoCargaObjetivos::create([
                        'fecha_inicio' => $this->fecha_inicio,
                        'fecha_fin' => $this->fecha_fin,
                        'habilitado' => $valor,
                    ]);

                    $this->alert('success', 'Periodo Habilitado.', [
                        'position' => 'center',
                        'timer' => '10000',
                        'toast' => true,
                        'text' => 'Se ha habilitado el periodo de carga de objetivos.',
                        'showConfirmButton' => false,
                        'onConfirmed' => '',
                        'confirmButtonText' => 'Entendido',
                    ]);
                } else {
                    $this->alert('warning', 'Fechas de periodo', [
                        'position' => 'center',
                        'timer' => '5000',
                        'toast' => true,
                        'text' => 'La fecha fin no puede ser menor a la fecha inicio.',
                        'showConfirmButton' => true,
                        'onConfirmed' => '',
                        'confirmButtonText' => 'Entendido',
                    ]);
                }
            } else {
                $this->alert('warning', 'Fechas de periodo', [
                    'position' => 'center',
                    'timer' => '5000',
                    'toast' => true,
                    'text' => 'Debe seleccionar una fecha de inicio y de fin para habilitar el periodo.',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Entendido',
                ]);
            }
        } else {
            PeriodoCargaObjetivos::first()->delete();

            $this->alert('success', 'Periodo Deshabilitado.', [
                'position' => 'center',
                'timer' => '10000',
                'toast' => true,
                'text' => 'Se ha deshabilitado el periodo de carga de objetivos.',
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'confirmButtonText' => 'Entendido',
            ]);

            $this->fecha_inicio = null;
            $this->fecha_fin = null;
        }
    }
}
