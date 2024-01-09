<?php

namespace App\Livewire\Timesheet;

use App\Exports\Timesheet\EmpleadosTimesheetExcel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class EmpleadosTimesheetExport extends Component
{
    public $tipo;

    public function mount(string $tipo = 'xlsx')
    {
        $this->tipo = $tipo;
    }

    public function render()
    {
        return view('livewire.timesheet.empleados-timesheet-export');
    }

    public function exportTo($tipo)
    {
        return Excel::download(new EmpleadosTimesheetExcel($tipo), 'empleados-timesheet.xlsx');
    }
}
