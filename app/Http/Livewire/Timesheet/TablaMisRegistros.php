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
        $this->times = Timesheet::getPersonalTimesheet();
    }

    public function render()
    {
        $this->todos_contador = Timesheet::getPersonalTimesheet()->count();
        $this->borrador_contador = Timesheet::getPersonalTimesheet()->where('estatus', 'papelera')->count();
        $this->pendientes_contador = Timesheet::getPersonalTimesheet()->where('estatus', 'pendiente')->count();
        $this->aprobados_contador = Timesheet::getPersonalTimesheet()->where('estatus', 'aprobado')->count();
        $this->rechazos_contador = Timesheet::getPersonalTimesheet()->where('estatus', 'rechazado')->count();

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
