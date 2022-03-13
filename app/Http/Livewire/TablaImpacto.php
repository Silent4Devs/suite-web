<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TablaImpacto extends Component
{
    public $columnas=[
        ['nivel'=>'Sin impacto']
    ];
    public $indexColumna=1;
    public $clasificacion='Hola';
    public function addColumn($indexColumna){

        // $indexColumna=$indexColumna+1;
        $this->indexColumna=$indexColumna;
        array_push($this->columnas,['nivel'=>'otro']);
        $this->emit('cerrarModal');
    }

    public function render()
    {
        return view('livewire.tabla-impacto');
    }
}
