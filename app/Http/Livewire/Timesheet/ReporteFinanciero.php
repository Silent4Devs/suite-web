<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoEmpleado;
use App\Traits\ObtenerOrganizacion;
use Livewire\Component;

class ReporteFinanciero extends Component
{
    public $selectedProjectId;

    public $proyectos_select;

    public $proyectos;

    public $empleados = [];

    public $areas = [];

    use ObtenerOrganizacion;

    public function render()
    {
        $this->proyectos_select = TimesheetProyecto::getAllWithData();
        $this->proyectos_select = $this->proyectos_select->sortByDesc('is_num');
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $this->proyectos = null;
        if ($this->selectedProjectId) {
            $selectedProjectId = $this->selectedProjectId;
            $proyectoId = $selectedProjectId;

            $ids_emp = TimesheetProyectoEmpleado::where('proyecto_id', $proyectoId)->get(['empleado_id', 'area_id', 'costo_hora']);
            $empleadosIds = $ids_emp->pluck('empleado_id');

            $horas = TimesheetHoras::where('proyecto_id', $proyectoId)
                ->whereIn('empleado_id', $empleadosIds)
                ->get(['empleado_id', 'horas_lunes', 'horas_martes', 'horas_miercoles', 'horas_jueves', 'horas_viernes', 'horas_sabado', 'horas_domingo']);

            $empleados = [];
            foreach ($ids_emp as $emp_p) {
                $total_horas = 0;

                foreach ($horas as $hora) {
                    if ($hora->empleado_id === $emp_p->empleado_id) {
                        $total_horas += array_sum(array_filter([
                            $hora->horas_lunes,
                            $hora->horas_martes,
                            $hora->horas_miercoles,
                            $hora->horas_jueves,
                            $hora->horas_viernes,
                            $hora->horas_sabado,
                            $hora->horas_domingo,
                        ], 'is_numeric'));
                    }
                }

                $costo_por_hora_usuario = $emp_p->costo_hora ?? 0;
                $costo_horas = $costo_por_hora_usuario * $total_horas;

                $empleado = Empleado::select('id', 'name')->find($emp_p->empleado_id);
                $area = Area::select('id', 'area')->find($emp_p->area_id);
                $proyecto = TimesheetProyecto::select('id', 'proyecto', 'estatus', 'cliente_id', 'identificador')->find($proyectoId);
                $cliente = TimesheetCliente::select('id', 'nombre')->find($proyecto->cliente_id);

                $horasTotalesProyecto = $this->getHorasTotales($proyectoId);

                $costoTotal = $horasTotalesProyecto['horasCosto'];
                $horaTotal = $horasTotalesProyecto['totalhoras'];

                $empleados[$empleado->id] = [
                    'id' => $empleado->id,
                    'name' => $empleado->name,
                    'area_id' => $emp_p->area_id,
                    'area' => $area->area,
                    'id_proyecto' => $proyecto->id,
                    'proyecto' => $proyecto->proyecto,
                    'estatus' => $proyecto->estatus,
                    'horasEmpleado' => $total_horas,
                    'costoHoraEmpleado' => $costo_horas,
                    'cliente' => $cliente->nombre,
                    'horaTotal' => $horaTotal,
                    'costoTotal' => $costoTotal,
                    'identificador' => $proyecto->identificador,

                ];
            }
            $this->emit('afterLivewireUpdate');
            //dd($selectedProjectId);

            $this->proyectos = $empleados;
        }
        $this->emit('afterLivewireUpdate');

        return view('livewire.timesheet.reporte-financiero', compact('logo_actual', 'empresa_actual'));
    }

    public function getHorasTotales($id)
    {
        $ids_emp = TimesheetProyectoEmpleado::where('proyecto_id', $id)->get();
        $horasTotales = 0;
        $horasCosto = 0;
        $totalhoras = 0;
        foreach ($ids_emp as $emp_p) {

            $empItem = Empleado::select('id', 'name')->where('id', $emp_p->empleado_id)->first();
            $horas = TimesheetHoras::where('proyecto_id', $id)
                ->where('empleado_id', $empItem->id)
                ->get();
            // Si hay horas para este empleado, sumar las horas de los diferentes días

            $total_horas = 0;

            foreach ($horas as $hora) {
                $total_horas += is_numeric($hora->horas_lunes) ? $hora->horas_lunes : 0;
                $total_horas += is_numeric($hora->horas_martes) ? $hora->horas_martes : 0;
                $total_horas += is_numeric($hora->horas_miercoles) ? $hora->horas_miercoles : 0;
                $total_horas += is_numeric($hora->horas_jueves) ? $hora->horas_jueves : 0;
                $total_horas += is_numeric($hora->horas_viernes) ? $hora->horas_viernes : 0;
                $total_horas += is_numeric($hora->horas_sabado) ? $hora->horas_sabado : 0;
                $total_horas += is_numeric($hora->horas_domingo) ? $hora->horas_domingo : 0;
            }
            $horasTotales = $total_horas;
            $totalhoras += $horasTotales;
            $costo_por_hora_usuario = $emp_p->costo_hora ?? 0;

            if (! $costo_por_hora_usuario) {
                if (isset($emp_p->empleado->salario_base_mensual)) {
                    $costo_por_hora_usuario = ($emp_p->empleado->salario_base_mensual / 20) / 7;
                } else {
                    if (isset($emp_p->empleado->salario_diario)) {
                        $costo_por_hora_usuario = $emp_p->empleado->salario_diario / 7;
                    } else {
                        $costo_por_hora_usuario = 0;
                    }
                }
            }
            $horasCosto += $costo_por_hora_usuario * $horasTotales;
        }

        return [
            'horasCosto' => $horasCosto,
            'totalhoras' => $totalhoras,
        ];
    }
}
