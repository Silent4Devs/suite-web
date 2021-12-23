<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Empleado;

class EventosPortal extends Component
{
    public $nuevos;
    public $cumpleaños;
    public $aniversarios;
    public $empleado_asignado;

    public function mount()
    {

    }

    public function render()
    {

        $hoy = Carbon::now();
        $hoy->toDateString();
        $nuevos = Empleado::whereBetween('antiguedad', [$hoy->firstOfMonth()->format('Y-m-d'), $hoy->endOfMonth()->format('Y-m-d')])->get();

        $cumpleaños = Empleado::whereMonth('cumpleaños', '=', $hoy->format('m'))->get();

        $aniversarios = Empleado::whereMonth('antiguedad', '=', $hoy->format('m'))->get();

        $empleado_asignado = auth()->user()->n_empleado;

        return view('livewire.eventos-portal');
    }
}
