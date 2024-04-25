<?php

namespace App\Http\Livewire\Timesheet;

use Livewire\Component;
use App\Models\TimesheetProyecto;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use Carbon\Carbon;

class FinanzasDashboard extends Component
{
    public $proyectos;

    public function render()
    {
        $this->proyectos = TimesheetProyecto::getAllWithData();
        $this->proyectos = $this->proyectos->sortByDesc('is_num');

        return view('livewire.timesheet.finanzas-dashboard');
    }

    public function search($data)
    {
        $mes = Carbon::parse($data['mes'])->format('m');
        $año = Carbon::parse($data['mes'])->format('Y');

        $proyecto = TimesheetProyecto::find($data['proyecto']);

        $horas = TimesheetHoras::where('proyecto_id', $data['proyecto']);

        $times = Timesheet::whereMonth('fecha_dia', $mes)->whereYear('fecha_dia', $año)->get();

        dd($proyecto->id, $mes, $año, $times);
    }
}
