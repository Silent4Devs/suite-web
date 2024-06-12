<?php

namespace App\Http\Livewire;

use App\Models\TimesheetProyecto;
use Livewire\Component;

class EditIdentificadorProyectosIntExt extends Component
{
    public $proyecto;

    public $identificador_proyect;

    public $select_tipos = [];

    public $tipo;

    public $mensaje = null;

    public $class = 'success';

    public $colorTexto = '';

    public function mount($id_proyecto)
    {
        $this->proyecto = TimesheetProyecto::where('id', $id_proyecto)->first();

        $this->identificador_proyect = $this->proyecto->identificador;

        $busqueda = TimesheetProyecto::select('tipo')->where('identificador', $this->proyecto->identificador)->get()->pluck('tipo')->toArray();

        $this->select_tipos = array_diff(TimesheetProyecto::TIPOS, $busqueda);

        // dd($this->select_tipos);

        if (count($busqueda) == 1) {
            if (!empty($busqueda) && $busqueda[0] == 'Interno') {
                $this->mensaje = 'Este Identificador se encuentra en uso por un proyecto interno.';
                $this->colorTexto = 'orange';
            } elseif (!empty($busqueda) && $busqueda[0] == 'Externo') {
                $this->mensaje = 'Este Identificador se encuentra en uso por un proyecto externo.';
                $this->colorTexto = 'orange';
            } else {
                $this->mensaje = 'Este Identificador no esta disponible.';
                $this->colorTexto = 'red';
                $this->class = 'error';
            }
        } elseif (count($busqueda) == 2) {
            $this->mensaje = 'Este Identificador no esta disponible.';
            $this->colorTexto = 'red';
            $this->class = 'error';
        } elseif (count($busqueda) == 0) {
            $this->mensaje = 'El Identificador esta disponible.';
            $this->colorTexto = 'green';
            $this->class = 'error';
        }

        $this->select_tipos = [$this->proyecto->tipo => $this->proyecto->tipo];
        $this->tipo = $this->proyecto->tipo;
    }

    public function render()
    {
        return view('livewire.edit-identificador-proyectos-int-ext');
    }

    public function updatedIdentificadorProyect($text)
    {
        // $busqueda = TimesheetProyecto::select('tipo')->where('identificador', $text)->get()->toArray();
        $busqueda = TimesheetProyecto::select('tipo')->where('identificador', $text)->get()->pluck('tipo')->toArray();
        $busquedaID = TimesheetProyecto::select('id')->where('identificador', $text)->get()->pluck('id')->toArray();

        $this->select_tipos = array_diff(TimesheetProyecto::TIPOS, $busqueda);

        // dd($this->select_tipos);

        if (count($busqueda) == 1) {
            if (!empty($busqueda) && $busqueda[0] == 'Interno') {
                $this->mensaje = 'Este Identificador se encuentra en uso por un proyecto interno.';
                $this->colorTexto = 'orange';
            } elseif (!empty($busqueda) && $busqueda[0] == 'Externo') {
                $this->mensaje = 'Este Identificador se encuentra en uso por un proyecto externo.';
                $this->colorTexto = 'orange';
            } else {
                $this->mensaje = 'Este Identificador no esta disponible.';
                $this->colorTexto = 'red';
                $this->class = 'error';
            }
        } elseif (count($busqueda) == 2) {
            $this->mensaje = 'Este Identificador no esta disponible.';
            $this->colorTexto = 'red';
            $this->class = 'error';
        } elseif (count($busqueda) == 0) {
            $this->mensaje = 'El Identificador esta disponible.';
            $this->colorTexto = 'green';
            $this->class = 'success';
        }

        foreach ($busquedaID as $key_busqueda => $b) {
            if ($this->proyecto->id == $b) {
                $this->select_tipos = [$this->proyecto->tipo => $this->proyecto->tipo];
            }
        }
        // dd($busqueda);
    }
}
