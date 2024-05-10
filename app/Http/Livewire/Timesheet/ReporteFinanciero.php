<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
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
        $this->proyectos_select = TimesheetProyecto::getAllWithData()->sortByDesc('is_num');
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $this->proyectos = null;

        if ($this->selectedProjectId) {
            $proyectoId = $this->selectedProjectId;

            $ids_emp = TimesheetProyectoEmpleado::where('proyecto_id', $proyectoId)->get(['empleado_id', 'area_id', 'costo_hora']);
            $empleadosIds = $ids_emp->pluck('empleado_id');

            $horas = TimesheetHoras::where('proyecto_id', $proyectoId)
                ->with('timesheet')
                ->whereHas('timesheet', function ($query) {
                    $query->where('estatus', 'aprobado');
                })
                ->whereIn('empleado_id', $empleadosIds)
                ->get(['empleado_id', 'horas_lunes', 'horas_martes', 'horas_miercoles', 'horas_jueves', 'horas_viernes', 'horas_sabado', 'horas_domingo']);

            $empleados = [];

            foreach ($ids_emp as $emp_p) {
                $total_horas = $horas->where('empleado_id', $emp_p->empleado_id)->sum(function ($hora) {
                    return array_sum(array_filter([
                        $hora->horas_lunes,
                        $hora->horas_martes,
                        $hora->horas_miercoles,
                        $hora->horas_jueves,
                        $hora->horas_viernes,
                        $hora->horas_sabado,
                        $hora->horas_domingo
                    ], 'is_numeric'));
                });

                $costo_por_hora_usuario = $emp_p->costo_hora ?? 0;
                if (!$costo_por_hora_usuario) {
                    $salario_base = $emp_p->empleado->salario_base_mensual ?? $emp_p->empleado->salario_diario ?? 0;
                    $costo_por_hora_usuario = ($salario_base / 20) / 7;
                }

                $empleado = Empleado::select('id', 'name')->find($emp_p->empleado_id);
                $area = Area::select('id', 'area')->find($emp_p->area_id);
                $proyecto = TimesheetProyecto::select('id', 'proyecto', 'estatus', 'cliente_id', 'identificador')->find($proyectoId);
                $cliente = TimesheetCliente::select('id', 'nombre')->find($proyecto->cliente_id);

                $horasTotalesProyecto = $this->getHorasTotales($proyectoId);

                $empleados[$empleado->id] = [
                    'id' => $empleado->id,
                    'name' => $empleado->name,
                    'area_id' => $emp_p->area_id,
                    'area' => $area->area,
                    'id_proyecto' => $proyecto->id,
                    'proyecto' => $proyecto->proyecto,
                    'estatus' => $proyecto->estatus,
                    'horasEmpleado' => $total_horas,
                    'costoHoraEmpleado' => $costo_por_hora_usuario * $total_horas,
                    'cliente' => $cliente->nombre,
                    'horaTotal' => $horasTotalesProyecto['totalhoras'],
                    'costoTotal' => $horasTotalesProyecto['horasCosto'],
                    'identificador' => $proyecto->identificador,
                ];
            }

            $this->proyectos = $empleados;
        }

        $this->emit('scriptTabla');
        return view('livewire.timesheet.reporte-financiero', compact('logo_actual', 'empresa_actual'));
    }


    public function getHorasTotales($id)
    {
        $ids_emp = TimesheetProyectoEmpleado::where('proyecto_id', $id)->get();

        $horas = TimesheetHoras::where('proyecto_id', $id)
            ->with('timesheet')
            ->whereHas('timesheet', function ($query) {
                $query->where('estatus', 'aprobado');
            })
            ->whereIn('empleado_id', $ids_emp->pluck('empleado_id'))
            ->get();

        $horasTotales = $horasCosto = $totalhoras = 0;

        foreach ($ids_emp as $emp_p) {
            $horasEmpleado = $horas->where('empleado_id', $emp_p->empleado_id);
            $total_horas = $horasEmpleado->sum('horas_lunes')
                + $horasEmpleado->sum('horas_martes')
                + $horasEmpleado->sum('horas_miercoles')
                + $horasEmpleado->sum('horas_jueves')
                + $horasEmpleado->sum('horas_viernes')
                + $horasEmpleado->sum('horas_sabado')
                + $horasEmpleado->sum('horas_domingo');

            $horasTotales += $total_horas;
            $costo_por_hora_usuario = $emp_p->costo_hora ?? 0;
            if (!$costo_por_hora_usuario) {
                $salario_base = $emp_p->empleado->salario_base_mensual ?? $emp_p->empleado->salario_diario ?? 0;
                $costo_por_hora_usuario = ($salario_base / 20) / 7;
            }
            $horasCosto += $costo_por_hora_usuario * $total_horas;
        }
        return [
            'horasCosto' => $horasCosto,
            'totalhoras' => $horasTotales
        ];
    }
}
