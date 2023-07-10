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
    public $area_id = 0;
    public $estatus;
    public $fecha_inicio;
    public $fecha_fin;
    public $emp;
    public $emp_id;
    public $apr;
    public $apr_id;
    public $proy;
    public $proy_id;
    public $datos_dash;

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

        $grafico = [];
        if($this->proy_id != 0){
            $this->datos_dash = TimesheetHoras::where('proyecto_id', $this->proy_id)->get();

            $p = TimesheetProyecto::find($this->proy_id);
            // dump($this->proy_id,$p);

            $sumalun = ($this->datos_dash)->sum('horas_lunes');
            $sumamar = ($this->datos_dash)->sum('horas_martes');
            $sumamie = ($this->datos_dash)->sum('horas_miercoles');
            $sumajue = ($this->datos_dash)->sum('horas_jueves');
            $sumavie = ($this->datos_dash)->sum('horas_viernes');

            $total_h = $sumalun + $sumamar + $sumamie + $sumajue + $sumavie;
            array_push($grafico, [
                'proyecto' => $p->proyecto,
                'horas_totales' => $total_h,
            ]);
            // dump($grafico);
        }
        //else{
        //     // foreach($lista_areas as $ar){
        //         $this->datos_dash = TimesheetHoras::with('proyecto')->where('proyecto_id', $this->proy_id)->get();
        //     // }
        //     // dd($this->proy_id, $this->area_id, $this->datos_dash);


        // }
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
