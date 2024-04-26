<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Empleado;
use Livewire\Component;
use App\Models\TimesheetProyecto;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyectoEmpleado;
use Carbon\Carbon;

class FinanzasDashboard extends Component
{
    public $proyectos;
    public $array;
    public $nombre;
    public $horastrabajada;

    public function render()
    {
        $this->proyectos = TimesheetProyecto::getAllWithData();
        $this->proyectos = $this->proyectos->sortByDesc('is_num');

        $this->array = ['a', 'b', 'c', 'd'];

        return view('livewire.timesheet.finanzas-dashboard');
    }

    public function search($data)
    {
        $mes = Carbon::parse($data['mes'])->format('m');
        $año = Carbon::parse($data['mes'])->format('Y');

        $ids_emp = TimesheetProyectoEmpleado::where('proyecto_id', $data['proyecto'])->get();
        $usuarios = [];
        $nombres = [];
        $horas_trabajadas = [];

        foreach ($ids_emp as $key => $emp_p) {
            $horas = TimesheetHoras::where('proyecto_id', $data['proyecto'])
                ->whereMonth('updated_at', $mes)
                ->whereYear('updated_at', $año)
                ->get();

            $horas_totales = 0;
            foreach ($horas as $hora) {
                $horas_totales += is_numeric($hora->horas_lunes) ? $hora->horas_lunes : 0;
                $horas_totales += is_numeric($hora->horas_martes) ? $hora->horas_martes : 0;
                $horas_totales += is_numeric($hora->horas_miercoles) ? $hora->horas_miercoles : 0;
                $horas_totales += is_numeric($hora->horas_jueves) ? $hora->horas_jueves : 0;
                $horas_totales += is_numeric($hora->horas_viernes) ? $hora->horas_viernes : 0;
                $horas_totales += is_numeric($hora->horas_sabado) ? $hora->horas_sabado : 0;
                $horas_totales += is_numeric($hora->horas_domingo) ? $hora->horas_domingo : 0;
            }

            if (isset($emp_p->empleado->salario_base_mensual)) {
                $costo_hora = ($emp_p->empleado->salario_base_mensual / 20) / 7;
            } else {
                if (isset($emp_p->empleado->salario_diario)) {
                    $costo_hora = $emp_p->empleado->salario_diario / 7;
                } else {
                    $costo_hora = 0;
                }
            }

            $costo_horas = $costo_hora * $horas_totales;

            $empItem = Empleado::select('id', 'name')->where('id', $emp_p->empleado_id)->first();

            // Almacenar información del usuario en un array asociativo con el ID como clave
            $usuarios[$empItem->id] = [
                'id' => $empItem->id,
                'name' => $empItem->name,
                'horas' => $horas_totales,
                'costo_horas' => $costo_horas,
            ];

            $nombres[] = $empItem->name;
            $horas_trabajadas[] = $horas_totales;
        }

        //dd($ids_emp,$data,$this->nombre= $nombres,$this->horastrabajada = $horas_trabajadas);
        $this->nombre = $nombres;
        $this->horastrabajada = $horas_trabajadas;
        $this->emit('datosActualizados', $this->nombre = $nombres, $this->horastrabajada = $horas_trabajadas);
    }
}
