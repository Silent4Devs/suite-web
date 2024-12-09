<?php

namespace App\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetTarea;
use Livewire\Component;
use VXM\Async\AsyncFacade as Async;

class DashboardProyectos extends Component
{
    // public $times;
    public $areas;

    public $area_id = 'todas';

    public $estatus = 'todos';

    public $fecha_inicio;

    public $fecha_fin;

    public $proy;

    public $proy_id;

    public $datos_areas;

    public $datos_empleados;

    public function mount()
    {
        // $this->estatus = 0;
        // $this->areas = Area::get();
        // $this->emp = Empleado::orderBy('name', 'ASC')->get();
        // $this->proy = TimesheetProyecto::orderBy('proyecto', 'ASC')->get();
    }

    public function updatedEstatus($value)
    {
        $this->estatus = $value;
    }

    public function updatedAreaId($value)
    {
        $this->area_id = $value;
    }

    public function updatedProyectoId($value)
    {
        $this->proy_id = $value;
        $this->area_id = 'todas';
    }

    public function render()
    {
        $this->datos_areas = collect();

        $time_getall = TimesheetProyecto::getIdNameAll();
        $time_getall = $time_getall->sortByDesc('is_num');
        $time_area = TimesheetProyectoArea::getWithArea();

        if ($this->estatus === 'todos') {
            $this->proy = $time_getall;
        } else {
            $this->proy = $time_getall->where('estatus', $this->estatus);
        }

        $lista_proyectos = $this->proy;
        // dd($lista_proyectos);

        if ($this->proy_id === 0) {
            $this->areas = $time_area;
        } else {
            $this->areas = $time_area->where('proyecto_id', $this->proy_id);
        }

        $lista_areas = $this->areas;

        if ($this->proy_id != 0) {
            if ($this->area_id === 'todas') {
                $datos_dash = TimesheetProyecto::getAll($this->proy_id)->where('id', '=', $this->proy_id);

                $this->datos_areas = collect();
                foreach ($lista_areas as $ar) {
                    $timesheet = Timesheet::with(['horas', 'empleado'])
                        ->where('estatus', 'aprobado')
                        ->whereHas('horas', function ($q) {
                            $q->where('proyecto_id', $this->proy_id);
                            // ->orWhere('estatus', 'pendiente');
                        })
                        ->whereHas('empleado', function ($q) use ($ar) {
                            $q->where('area_id', $ar->area->id);
                            // ->orWhere('estatus', 'pendiente');
                        })
                        ->get();
                    // dd($timesheet);
                    $total_h = 0;
                    $total_he = 0;
                    $t = 0;
                    foreach ($timesheet as $ts) {
                        $total_h = 0;
                        foreach ($ts->horas as $key => $tsh) {
                            // dd($tsh->proyecto_id, $this->proy_id);
                            if ($tsh->proyecto_id == $this->proy_id) {
                                $sumalun = is_numeric($tsh->horas_lunes) ? $tsh->horas_lunes : 0;
                                $sumamar = is_numeric($tsh->horas_martes) ? $tsh->horas_martes : 0;
                                $sumamie = is_numeric($tsh->horas_miercoles) ? $tsh->horas_miercoles : 0;
                                $sumajue = is_numeric($tsh->horas_jueves) ? $tsh->horas_jueves : 0;
                                $sumavie = is_numeric($tsh->horas_viernes) ? $tsh->horas_viernes : 0;
                                $sumasab = is_numeric($tsh->horas_sabado) ? $tsh->horas_sabado : 0;
                                $sumadom = is_numeric($tsh->horas_domingo) ? $tsh->horas_domingo : 0;

                                $total_h = $total_h + $sumalun + $sumamar + $sumamie + $sumajue + $sumavie + $sumasab + $sumadom;
                            }
                        }
                        $total_he = $total_he + $total_h;
                    }

                    $total_h = round($total_h, 2);
                    $total_he = round($total_he, 2);

                    $tareas = TimesheetTarea::where('proyecto_id', $this->proy_id)->get();

                    foreach ($tareas as $tar) {
                        if ($tar->todos == true) {
                            $t++;
                        } elseif ($tar->area_id == $ar->area->id) {
                            $t++;
                        }
                    }

                    $this->datos_areas->push([
                        'proyecto' => isset($datos_dash->proyecto) ? $datos_dash->proyecto : null,
                        'area' => $ar->area->area,
                        'total_horas_area' => $total_he,
                        'tareas' => $t,
                    ]);

                    $empproyectos = Timesheet::select('id', 'empleado_id', 'estatus')
                        ->with('horas', 'empleado')
                        ->where('estatus', 'aprobado')
                        ->whereHas('horas', function ($query) {
                            $query->where('proyecto_id', $this->proy_id);
                        })->distinct('empleado_id')
                        ->get();
                    //     dd($empproyectos);
                    // $empproyectos = Timesheet::select('timesheets.id', 'timesheets.empleado_id', 'timesheets.estatus')
                    //     ->join('horas', 'timesheets.id', '=', 'horas.timesheet_id')
                    //     ->with(['horas', 'empleado'])
                    //     ->where('timesheets.estatus', 'aprobado')
                    //     ->where('horas.proyecto_id', $this->proy_id)
                    //     ->distinct('timesheets.empleado_id')
                    //     ->get();
                    // dump($empproyectos);

                    $this->datos_empleados = collect();
                    foreach ($empproyectos as $ep) {
                        $emphoras = TimesheetHoras::where('proyecto_id', $this->proy_id)
                            ->with('timesheet')
                            ->whereHas('timesheet', function ($query) use ($ep) {
                                $query->where('empleado_id', $ep->empleado_id);
                            })
                            ->whereHas('timesheet', function ($query) {
                                $query->where('estatus', 'aprobado');
                                // ->orWhere('estatus', 'pendiente');
                            })->get();

                        $daysOfWeek = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
                        $total_emp = 0;

                        foreach ($daysOfWeek as $day) {
                            $total_emp += $emphoras->sum("horas_$day");
                        }

                        $total_emp = round($total_emp, 2);

                        $this->datos_empleados->push([
                            'horas_proyecto' => $total_emp,
                            'proyecto' => isset($datos_dash->proyecto) ? $datos_dash->proyecto : null,
                            'empleado' => $ep->empleado->name,
                            'area' => $ep->empleado->area->area,
                        ]);
                    }
                }

                $this->dispatch('renderAreas', [
                    'datos_areas' => $this->datos_areas->toArray(),
                    'datos_empleados' => $this->datos_empleados->toArray(),
                ]);
            } else {
                $datos_dash = TimesheetProyecto::getAll($this->proy_id)->where('id', '=', $this->proy_id);
                $area_individual = Area::select('area')->where('id', '=', $this->area_id);

                if (! isset($area_individual->area)) {
                    $area_individual = 'Sin definir';
                } else {
                    $area_individual = $area_individual->area;
                }

                $this->datos_areas = collect();
                $timesheet = Timesheet::with(['horas', 'empleado'])
                    ->where('estatus', 'aprobado')
                    ->whereHas('horas.timesheet', function ($q) {
                        $q->where('proyecto_id', $this->proy_id);
                        // ->orWhere('estatus', 'pendiente');
                    })
                    ->whereHas('empleado', function ($q) {
                        $q->where('area_id', $this->area_id);
                        // ->orWhere('estatus', 'pendiente');
                    })
                    ->get();
                // dd($timesheet);
                $total_h = 0;
                $t = 0;
                foreach ($timesheet as $ts) {
                    foreach ($ts->horas as $key => $tsh) {
                        // dd($tsh->proyecto_id, $this->proy_id);
                        if ($tsh->proyecto_id == $this->proy_id) {
                            $sumalun = $tsh->horas_lunes;
                            $sumamar = $tsh->horas_martes;
                            $sumamie = $tsh->horas_miercoles;
                            $sumajue = $tsh->horas_jueves;
                            $sumavie = $tsh->horas_viernes;
                            $sumasab = $tsh->horas_sabado;
                            $sumadom = $tsh->horas_domingo;

                            $total_h = $total_h + $sumalun + $sumamar + $sumamie + $sumajue + $sumavie + $sumasab + $sumadom;
                        }
                    }
                }

                $total_h = round($total_h, 2);

                $tareas = TimesheetTarea::where('proyecto_id', '=', $this->proy_id)->get();

                foreach ($tareas as $tar) {
                    if ($tar->todos == true) {
                        $t++;
                    } elseif ($tar->area_id == $this->area_id) {
                        $t++;
                    }
                }

                $this->datos_areas->push([
                    'proyecto' => isset($datos_dash->proyecto) ? $datos_dash->proyecto : null,
                    'area' => $area_individual,
                    'total_horas_area' => $total_h,
                    'tareas' => $t,
                ]);

                $empproyectos = Timesheet::select('id', 'empleado_id')
                    ->with('horas', 'empleado')
                    ->where('estatus', 'aprobado')
                    ->whereHas('horas', function ($query) {
                        $query->where('proyecto_id', $this->proy_id);
                    })
                    ->whereHas('empleado', function ($query) {
                        $query->where('area_id', $this->area_id);
                    })->distinct('empleado_id')->get();
                // dd($empproyectos);

                $this->datos_empleados = collect();
                foreach ($empproyectos as $ep) {
                    $emphoras = TimesheetHoras::where('proyecto_id', $this->proy_id)
                        ->with('timesheet')
                        ->whereHas('timesheet', function ($query) use ($ep) {
                            $query->where('empleado_id', $ep->empleado_id);
                        })
                        ->whereHas('timesheet', function ($query) {
                            $query->where('estatus', 'aprobado');
                        })->get();

                    $daysOfWeek = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
                    $total_emp = 0;

                    foreach ($daysOfWeek as $day) {
                        $total_emp += $emphoras->sum("horas_$day");
                    }

                    $total_emp = round($total_emp, 2);

                    $this->datos_empleados->push([
                        'horas_proyecto' => $total_emp,
                        'proyecto' => isset($datos_dash->proyecto) ? $datos_dash->proyecto : null,
                        'empleado' => $ep->empleado->name,
                        'area' => $area_individual,
                    ]);
                }

                // dd($this->datos_areas->toArray(), $this->datos_empleados);
                // $this->dispatch('renderAreas', datos_areas: $this->datos_areas, datos_empleados: $this->datos_empleados);
                $this->dispatch('renderAreas', [
                    'datos_areas' => $this->datos_areas->toArray(),
                    'datos_empleados' => $this->datos_empleados->toArray(),
                ]);
            }
        }
        // dd($datos_areas);
        // dd($lista_areas);

        return view('livewire.timesheet.dashboard-proyectos', compact('lista_proyectos', 'lista_areas'));
    }
}
