<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proceso;
use App\Models\Empleado;

class IndicadoresSgsiComponent extends Component
{
    public $nombre, $description, $formula, $frecuencia, $unidadmedida, $meta, $no_revisiones, $resultado, $id_empleado, $id_proceso;
    public $view = 'create';
    public $vars = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function render()
    {
        $responsables = Empleado::get();
        $procesos = Proceso::get();

        return view('livewire.indicadores-sgsi-component', [
            'responsables' => $responsables,
            'procesos' => $procesos,
        ]);
    }

    public function mount()
    {
    }

}
