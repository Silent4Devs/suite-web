<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Timesheet;
use Livewire\Component;

class ReportesRegistros extends Component
{
    public $todos_contador;
    public $borrador_contador;
    public $pendientes_contador;
    public $aprobados_contador;
    public $rechazos_contador;
    public $times;

    public function mount()
    {
        $this->times = Timesheet::get();
    }

    public function render()
    {
        $this->todos_contador = Timesheet::count();
        $this->borrador_contador = Timesheet::where('estatus', 'papelera')->count();
        $this->pendientes_contador = Timesheet::where('estatus', 'pendiente')->count();
        $this->aprobados_contador = Timesheet::where('estatus', 'aprobado')->count();
        $this->rechazos_contador = Timesheet::where('estatus', 'rechazado')->count();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-registros');
    }

    public function todos()
    {
        $this->times = Timesheet::get();
    }

    public function papelera()
    {
        $this->times = Timesheet::where('estatus', 'papelera')->get();
    }

    public function pendientes()
    {
        $this->times = Timesheet::where('estatus', 'pendiente')->get();
    }

    public function aprobados()
    {
        $this->times = Timesheet::where('estatus', 'aprobado')->get();
    }

    public function rechazos()
    {
        $this->times = Timesheet::where('estatus', 'rechazado')->get();
    }
}
