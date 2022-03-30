<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TablaImpacto extends Component
{
    public $columnas = [
        ['nivel'=>'Sin impacto'],
    ];
    public $indexColumna = 1;
    public $clasificacion = 'Hola';
    public $indexRow = 1;
    public $filas = [
        ['tipo'=>'Legal',
         'criterio'=>'criterio',
         'base'=>'base',
        ],
    ];
    public $criterio = 'criterio';
    public $base = 'base';

    public function addColumn($indexColumna)
    {

        // $indexColumna=$indexColumna+1;
        $this->indexColumna = $indexColumna;
        array_push($this->columnas, ['nivel'=>'otro']);
        $this->emit('cerrarModal');
    }

    public function addRow($indexRow)
    {
        $this->indexRow = $indexRow;
        array_push($this->filas, [
            'tipo'=>'Financiera',
            'criterio'=>'criterio',
            'base'=>'base',
        ]);
        $this->emit('cerrarModalImpacto');
    }

    public function render()
    {
        return view('livewire.tabla-impacto');
    }
}
