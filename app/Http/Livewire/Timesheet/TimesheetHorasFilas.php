<?php

namespace App\Http\Livewire\Timesheet;

use Livewire\Component;

class TimesheetHorasFilas extends Component
{
    public $proyectos;
    public $tareas;
    public $contador = 5;

    public function mount($proyectos, $tareas){
        $this->proyectos = $proyectos;
        $this->tareas = $tareas;
    }
    public function render()
    {

        return view('livewire.timesheet.timesheet-horas-filas');
    }

    public function agregarFila()
    {
        $this->contador = $this->contador + 1;

        dd($this->contador);
    }
}
