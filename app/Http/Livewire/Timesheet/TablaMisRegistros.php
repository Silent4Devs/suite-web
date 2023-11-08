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

    }

    public function render()
    {
        $this->times = Timesheet::getPersonalTimesheet();
        $this->todos_contador = $this->times->count();
        $this->borrador_contador = $this->times->where('estatus', 'papelera')->count();
        $this->pendientes_contador = $this->times->where('estatus', 'pendiente')->count();
        $this->aprobados_contador = $this->times->where('estatus', 'aprobado')->count();
        $this->rechazos_contador = $this->times->where('estatus', 'rechazado')->count();

        return view('livewire.timesheet.tabla-mis-registros');
    }

    public function todos()
    {
        $this->times = Timesheet::getPersonalTimesheet();
        $this->emit('scriptTabla');
    }

    public function papelera()
    {
        $this->times = Timesheet::getPersonalTimesheet()->where('estatus', 'papelera');
        $this->emit('scriptTabla');
    }

    public function pendientes()
    {
        $this->times = Timesheet::getPersonalTimesheet()->where('estatus', 'pendiente');
        $this->emit('scriptTabla');
    }

    public function aprobados()
    {
        $this->times = Timesheet::getPersonalTimesheet()->where('estatus', 'aprobado');
        $this->emit('scriptTabla');
    }

    public function rechazos()
    {
        $this->times = Timesheet::getPersonalTimesheet()->where('estatus', 'rechazado');
        $this->emit('scriptTabla');
    }
}
