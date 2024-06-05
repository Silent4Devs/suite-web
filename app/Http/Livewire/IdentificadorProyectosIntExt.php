<?php

namespace App\Http\Livewire;

use App\Models\TimesheetProyecto;
use Livewire\Component;

class IdentificadorProyectosIntExt extends Component
{
    public $identificador_proyect;

    public $select_tipos = [];

    public $tipo;

    public $mensaje = null;

    public $class = "success";

    public function mount()
    {
    }

    public function render()
    {

        // dd($this->select_tipos);

        return view('livewire.identificador-proyectos-int-ext');
    }

    public function updatedIdentificadorProyect($text)
    {
        // $busqueda = TimesheetProyecto::select('tipo')->where('identificador', $text)->get()->toArray();
        $busqueda = TimesheetProyecto::select('tipo')->where('identificador', $text)->get()->pluck('tipo')->toArray();

        $this->select_tipos = array_diff(TimesheetProyecto::TIPOS, $busqueda);

        // dd($this->select_tipos);

        if (!empty($busqueda) && $busqueda[0] == "Interno") {
            $this->mensaje = "Esta Identificador se encuentra en uso por un proyecto interno.";
        } elseif (!empty($busqueda) && $busqueda[0] == "Externo") {
            $this->mensaje = "Esta Identificador se encuentra en uso por un proyecto externo.";
        } else {
            $this->mensaje = "Esta Identificador no esta disponible.";
            $this->class = "error";
        }
        // dd($busqueda);
    }
}
