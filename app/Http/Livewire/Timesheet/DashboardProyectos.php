<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Timesheet;
use App\Models\Empleado;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetTarea;

class DashboardProyectos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $todos_contador;
    public $borrador_contador;
    public $pendientes_contador;
    public $aprobados_contador;
    public $rechazos_contador;
    public $totalRegistrosMostrando;
    public $perPage = 5;
    public $search;
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
                    $tareas = TimesheetTarea::with('proyecto', 'horas')->where('proyecto_id', $this->proy_id)->where('area_id', $ar->area->id)->groupBy('id', 'area_id')->get();
                    // dd($p);
                    $total_h = 0;
                    $t = 0;
                    foreach($tareas as $tarea){
                        $sumalun = ($tarea->horas)->sum('horas_lunes');
                        $sumamar = ($tarea->horas)->sum('horas_martes');
                        $sumamie = ($tarea->horas)->sum('horas_miercoles');
                        $sumajue = ($tarea->horas)->sum('horas_jueves');
                        $sumavie = ($tarea->horas)->sum('horas_viernes');

                        $total_h = $total_h + $sumalun + $sumamar + $sumamie + $sumajue + $sumavie;
                        $t++;
                    }

                    $this->datos_areas->push([
                        'proyecto' => $this->datos_dash->proyecto,
                        'area' => $ar->area->area,
                        'total_horas_area' => $total_h,
                        'tareas' => $t,
                    ]);

                }
                // dd($this->datos_areas);
                $this->emit('renderAreas', $this->datos_areas);
            }else{
                $this->datos_dash = TimesheetProyecto::find($this->proy_id);
                $area_individual = Area::find($this->area_id);

                if(!isset($area_individual->area)){
                    $area_individual = 'Sin definir';
                }else{
                    $area_individual = $area_individual->area;
                }

                $this->datos_areas= collect();
                    $tareas = TimesheetTarea::with('proyecto', 'horas', 'area')->where('proyecto_id', $this->proy_id)->where('area_id', $this->area_id)->groupBy('id', 'area_id')->get();
                    // dd($p);
                    $total_h = 0;
                    $t = 0;
                    foreach($tareas as $tarea){
                        // dd($tarea->area->area);
                        $sumalun = ($tarea->horas)->sum('horas_lunes');
                        $sumamar = ($tarea->horas)->sum('horas_martes');
                        $sumamie = ($tarea->horas)->sum('horas_miercoles');
                        $sumajue = ($tarea->horas)->sum('horas_jueves');
                        $sumavie = ($tarea->horas)->sum('horas_viernes');

                        $total_h = $total_h + $sumalun + $sumamar + $sumamie + $sumajue + $sumavie;
                        $t++;
                    }

                    $this->datos_areas->push([
                        'proyecto' => $this->datos_dash->proyecto,
                        'area' => $area_individual,
                        'total_horas_area' => $total_h,
                        'tareas' => $t,
                    ]);

                // dd($this->datos_areas);
                $this->emit('renderAreas', $this->datos_areas);

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
