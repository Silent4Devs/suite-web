<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Timesheet;
use Livewire\Component;

class TablaMisRegistros extends Component
{
    public $todos_contador;
    public $borrador_contador;
    public $pendientes_contador;
    public $aprobados_contador;
    public $rechazos_contador;
    public $times;

    public function mount()
    {
        $this->times = Timesheet::where('empleado_id', auth()->user()->empleado->id)->get();
    }

    public function render()
    {
        $this->todos_contador = Timesheet::where('empleado_id', auth()->user()->empleado->id)->count();
        $this->borrador_contador = Timesheet::where('estatus', 'papelera')->where('empleado_id', auth()->user()->empleado->id)->count();
        $this->pendientes_contador = Timesheet::where('estatus', 'pendiente')->where('empleado_id', auth()->user()->empleado->id)->count();
        $this->aprobados_contador = Timesheet::where('estatus', 'aprobado')->where('empleado_id', auth()->user()->empleado->id)->count();
        $this->rechazos_contador = Timesheet::where('estatus', 'rechazado')->where('empleado_id', auth()->user()->empleado->id)->count();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.tabla-mis-registros');
    }

    public function todos()
    {
        $this->times = Timesheet::where('empleado_id', auth()->user()->empleado->id)->get();
    }

    public function papelera()
    {
        $this->times = Timesheet::where('estatus', 'papelera')->where('empleado_id', auth()->user()->empleado->id)->get();
    }

    public function pendientes()
    {
        $this->times = Timesheet::where('estatus', 'pendiente')->where('empleado_id', auth()->user()->empleado->id)->get();
    }

    public function aprobados()
    {
        $this->times = Timesheet::where('estatus', 'aprobado')->where('empleado_id', auth()->user()->empleado->id)->get();
    }

    public function rechazos()
    {
        $this->times = Timesheet::where('estatus', 'rechazado')->where('empleado_id', auth()->user()->empleado->id)->get();
    }
}
