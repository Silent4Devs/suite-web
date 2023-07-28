<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetTarea;
use Livewire\Component;

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

        if ($this->estatus === 'todos') {
            $this->proy = TimesheetProyecto::orderBy('proyecto')->get();
        } else {
            $this->proy = TimesheetProyecto::where('estatus', $this->estatus)->orderBy('proyecto')->get();
        }

        $lista_proyectos = $this->proy;
        // dd($lista_proyectos);

        if ($this->proy_id === 0) {
            $this->areas = TimesheetProyectoArea::with('area')->get();
        } else {
            $this->areas = TimesheetProyectoArea::with('area')->where('proyecto_id', $this->proy_id)->get();
        }

        $lista_areas = $this->areas;

        if ($this->proy_id != 0) {
            if ($this->area_id === 'todas') {
                $this->datos_dash = TimesheetProyecto::find($this->proy_id);

                $this->datos_areas = collect();
                foreach ($lista_areas as $ar) {
                    $timesheet = Timesheet::with('horas')
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
                        $total_he = $total_he + $total_h;
                    }

                    $total_h = round($total_h, 2);
                    $total_he = round($total_he, 2);

                    $tareas = TimesheetTarea::where('proyecto_id', '=', $this->proy_id)->get();

                    foreach ($tareas as $tar) {
                        if ($tar->todos == true) {
                            $t++;
                        } elseif ($tar->area_id == $ar->area->id) {
                            $t++;
                        }
                    }

                    $this->datos_areas->push([
                        'proyecto' => $this->datos_dash->proyecto,
                        'area' => $ar->area->area,
                        'total_horas_area' => $total_he,
                        'tareas' => $t,
                    ]);

                    $empproyectos = Timesheet::select('id', 'empleado_id', 'estatus')
                        ->with('horas', 'empleado')
                        ->where('estatus', 'aprobado')
                        ->whereHas('horas', function ($query) {
                            $query->where('proyecto_id', $this->proy_id);
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
                                // ->orWhere('estatus', 'pendiente');
                            })->get();

                        $total_emp = 0;

                        $slun = $emphoras->sum('horas_lunes');
                        $smar = $emphoras->sum('horas_martes');
                        $smie = $emphoras->sum('horas_miercoles');
                        $sjue = $emphoras->sum('horas_jueves');
                        $svie = $emphoras->sum('horas_viernes');
                        $ssab = $emphoras->sum('horas_sabado');
                        $sdom = $emphoras->sum('horas_domingo');

                        $total_emp = $total_emp + $slun + $smar + $smie + $sjue + $svie + $ssab + $sdom;

                        $total_emp = round($total_emp, 2);

                        $this->datos_empleados->push([
                            'horas_proyecto' => $total_emp,
                            'proyecto' => $this->datos_dash->proyecto,
                            'empleado' => $ep->empleado->name,
                            'area' => $ep->empleado->area->area,
                        ]);
                    }
                }
                // dd($this->datos_areas);
                $this->emit('renderAreas', $this->datos_areas, $this->datos_empleados);
            } else {
                $this->datos_dash = TimesheetProyecto::find($this->proy_id);
                $area_individual = Area::find($this->area_id);

                if (! isset($area_individual->area)) {
                    $area_individual = 'Sin definir';
                } else {
                    $area_individual = $area_individual->area;
                }

                $this->datos_areas = collect();
                $timesheet = Timesheet::with('horas', 'empleado')
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
                    'proyecto' => $this->datos_dash->proyecto,
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

                    $total_emp = 0;

                    $slun = $emphoras->sum('horas_lunes');
                    $smar = $emphoras->sum('horas_martes');
                    $smie = $emphoras->sum('horas_miercoles');
                    $sjue = $emphoras->sum('horas_jueves');
                    $svie = $emphoras->sum('horas_viernes');
                    $ssab = $emphoras->sum('horas_sabado');
                    $sdom = $emphoras->sum('horas_domingo');

                    $total_emp = $total_emp + $slun + $smar + $smie + $sjue + $svie + $ssab + $sdom;

                    $total_emp = round($total_emp, 2);

                    $this->datos_empleados->push([
                        'horas_proyecto' => $total_emp,
                        'proyecto' => $this->datos_dash->proyecto,
                        'empleado' => $ep->empleado->name,
                        'area' => $area_individual,
                    ]);
                }

                // dd($this->datos_areas);
                $this->emit('renderAreas', $this->datos_areas, $this->datos_empleados);
            }
        }
        // dd($datos_areas);
        // dd($lista_areas);

        return view('livewire.timesheet.dashboard-proyectos', compact('lista_proyectos', 'lista_areas'));
    }
}
