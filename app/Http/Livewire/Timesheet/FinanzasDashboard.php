<?php

namespace App\Http\Livewire\Timesheet;

use Livewire\Component;
use App\Models\TimesheetProyecto;

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
        dd($data);
    }
}
