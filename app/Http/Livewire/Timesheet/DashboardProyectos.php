<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Timesheet;
use App\Models\Empleado;
use Livewire\Component;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetTarea;

class DashboardProyectos extends Component
{
    // public $times;
    public $areas;
    public $area_id = 'todas';
    public $estatus;
    public $fecha_inicio;
    public $fecha_fin;
    public $emp;
    public $emp_id;
    public $apr;
    public $apr_id;
    public $proy;
    public $proy_id;
    public $datos_areas;
    public $datos_empleados;

    public function mount()
    {
        $this->estatus = 0;
        // $this->areas = Area::get();
        // $this->emp = Empleado::orderBy('name', 'ASC')->get();
        $this->proy = TimesheetProyecto::orderBy('proyecto', 'ASC')->get();

    }

    public function updatedEstatus($value)
    {
        $this->estatus = $value;

    }

    public function updatedFechaFin($value)
    {
        $this->fecha_fin = $value;
    }

    public function updatedAreaId($value)
    {
        $this->area_id = $value;
    }

    public function updatedProyectoId($value)
    {
        $this->proy_id = $value;

    }

    public function render()
    {
        $this->datos_areas = collect();
        $area_individual;
        //Query para obtener los timesheet y filtrarlo
        if($this->estatus === 0){
            $this->proy = TimesheetProyecto::orderBy('proyecto')->get();
        }else{
            $this->proy = TimesheetProyecto::where('estatus', $this->estatus)->orderBy('proyecto')->get();
        }

        $lista_proyectos = $this->proy;

        if($this->proy_id === 0){
            $this->areas = TimesheetProyectoArea::with('area')->get();
        }else{
            $this->areas = TimesheetProyectoArea::with('area')->where('proyecto_id', $this->proy_id)->get();
        }

        $lista_areas = $this->areas;

        if($this->proy_id != 0 ){
            if($this->area_id === 'todas'){
                $this->datos_dash = TimesheetProyecto::find($this->proy_id);

                $this->datos_areas= collect();
                foreach($lista_areas as $ar){
                    $tareas = TimesheetTarea::with('proyecto', 'horas')
                    ->where('proyecto_id', $this->proy_id)
                    ->where('area_id', $ar->area->id)
                    ->whereHas('horas.timesheet', function ($q) {
                        $q->where('estatus', 'aprobado');
                            // ->orWhere('estatus', 'pendiente');
                      })
                    ->get();
                    // dd($tareas);
                    $total_h = 0;
                    $t = 0;
                    foreach($tareas as $tarea){
                        // dd($tarea);
                        foreach($tarea->horas as $key => $timehoras){
                            // dd($timehoras);
                            if($timehoras->timesheet->estatus === 'aprobado'){
                                $sumalun = $timehoras->horas_lunes;
                                $sumamar = $timehoras->horas_martes;
                                $sumamie = $timehoras->horas_miercoles;
                                $sumajue = $timehoras->horas_jueves;
                                $sumavie = $timehoras->horas_viernes;
                                $sumasab = $timehoras->horas_sabado;
                                $sumadom = $timehoras->horas_domingo;

                                $total_h = $total_h + $sumalun + $sumamar + $sumamie + $sumajue + $sumavie + $sumasab + $sumadom;
                            }
                        }
                        $t++;
                    }

                    $this->datos_areas->push([
                        'proyecto' => $this->datos_dash->proyecto,
                        'area' => $ar->area->area,
                        'total_horas_area' => $total_h,
                        'tareas' => $t,
                    ]);

                    $empproyectos = Timesheet::select('id','empleado_id', 'estatus')
                    ->with('horas', 'empleado')
                    ->where('estatus', 'aprobado')
                    ->whereHas('horas', function($query){
                        $query->where('proyecto_id', $this->proy_id);
                    })->distinct('empleado_id')->get();
                    // dd($empproyectos);

                    $this->datos_empleados = collect();
                    foreach($empproyectos as $ep){

                        $emphoras = TimesheetHoras::where('proyecto_id', $this->proy_id)
                        ->with('timesheet')
                        ->whereHas('timesheet', function($query) use ($ep){
                            $query->where('empleado_id', $ep->empleado_id);
                        })
                        ->whereHas('timesheet', function($query) use ($ep){
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

                        $total_emp = $total_emp + $slun + $smar + $smie + $sjue + $svie +$ssab + $sdom;
                        $this->datos_empleados->push([
                            'horas_proyecto' => $total_emp,
                            'proyecto' => $this->datos_dash->proyecto,
                            'empleado' => $ep->empleado->name,
                        ]);
                    }

                }
                // dd($this->datos_areas);
                $this->emit('renderAreas', $this->datos_areas, $this->datos_empleados);
            }else{
                $this->datos_dash = TimesheetProyecto::find($this->proy_id);
                $area_individual = Area::find($this->area_id);

                if(!isset($area_individual->area)){
                    $area_individual = 'Sin definir';
                }else{
                    $area_individual = $area_individual->area;
                }

                $this->datos_areas= collect();
                    $tareas = TimesheetTarea::with('proyecto', 'horas', 'area')
                    ->where('proyecto_id', $this->proy_id)
                    ->where('area_id', $this->area_id)
                    ->whereHas('horas.timesheet', function ($q) {
                        $q->where('estatus', 'aprobado');
                      })
                    ->groupBy('id', 'area_id')->get();
                    // dd($p);
                    $total_h = 0;
                    $t = 0;
                    foreach($tareas as $tarea){
                        // dd($tarea->area->area);
                        foreach($tarea->horas as $key => $timehoras){
                            // dd($timehoras);
                            if($timehoras->timesheet->estatus === 'aprobado'){
                                $sumalun = $timehoras->horas_lunes;
                                $sumamar = $timehoras->horas_martes;
                                $sumamie = $timehoras->horas_miercoles;
                                $sumajue = $timehoras->horas_jueves;
                                $sumavie = $timehoras->horas_viernes;
                                $sumasab = $timehoras->horas_sabado;
                                $sumadom = $timehoras->horas_domingo;

                                $total_h = $total_h + $sumalun + $sumamar + $sumamie + $sumajue + $sumavie + $sumasab + $sumadom;
                            }
                        }
                        $t++;
                    }

                    $this->datos_areas->push([
                        'proyecto' => $this->datos_dash->proyecto,
                        'area' => $area_individual,
                        'total_horas_area' => $total_h,
                        'tareas' => $t,
                    ]);

                    $empproyectos = Timesheet::select('id','empleado_id')
                    ->with('horas', 'empleado')
                    ->where('estatus', 'aprobado')
                    ->whereHas('horas', function($query){
                        $query->where('proyecto_id', $this->proy_id);
                    })
                    ->whereHas('empleado', function($query){
                        $query->where('area_id', $this->area_id);
                    })->distinct('empleado_id')->get();
                    // dd($empproyectos);

                    $this->datos_empleados = collect();
                    foreach($empproyectos as $ep){

                        $emphoras = TimesheetHoras::where('proyecto_id', $this->proy_id)
                        ->with('timesheet')
                        ->whereHas('timesheet', function($query) use ($ep){
                            $query->where('empleado_id', $ep->empleado_id);
                        })
                        ->whereHas('timesheet', function($query) use ($ep){
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

                        $total_emp = $total_emp + $slun + $smar + $smie + $sjue + $svie +$ssab + $sdom;
                        $this->datos_empleados->push([
                            'horas_proyecto' => $total_emp,
                            'proyecto' => $this->datos_dash->proyecto,
                            'empleado' => $ep->empleado->name,
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

    public function todos()
    {
        // $this->times = Timesheet::whereHas('empleado', function ($query) {
        //     if ($this->area_id == 0) {
        //         return $query;
        //     } else {
        //         $query->where('area_id', $this->area_id);
        //     }
        // })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
        $this->estatus = null;
    }

}
