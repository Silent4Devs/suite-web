<?php

namespace App\Livewire;

use App\Models\TimesheetProyecto;
use Livewire\Component;

class IdentificadorProyectosIntExt extends Component
{
    public $identificador_proyect;

    public $select_tipos = [];

    public $tipo;

    public $mensaje = null;

    public $class = 'success';

    public $colorTexto = '';

    public function mount() {}

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

        if (count($busqueda) == 1) {
            if (! empty($busqueda) && $busqueda[0] == 'Interno') {
                $this->mensaje = 'Este Identificador se encuentra en uso por un proyecto interno.';
                $this->colorTexto = 'orange';
            } elseif (! empty($busqueda) && $busqueda[0] == 'Externo') {
                $this->mensaje = 'Este Identificador se encuentra en uso por un proyecto externo.';
                $this->colorTexto = 'orange';
            } else {
                $this->mensaje = 'Este Identificador no esta disponible.';
                $this->class = 'error';
                $this->colorTexto = 'red';
            }
        } elseif (count($busqueda) == 2) {
            $this->mensaje = 'Este Identificador no esta disponible.';
            $this->class = 'error';
            $this->colorTexto = 'red';
        } elseif (count($busqueda) == 0) {
            $this->mensaje = 'El Identificador esta disponible.';
            $this->class = 'error';
            $this->colorTexto = 'green';
        }
    }
}
