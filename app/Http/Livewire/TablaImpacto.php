<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TipoImpacto;
use App\Models\NivelesImpacto;

class TablaImpacto extends Component
{
    public $columnas = [
    ];
    public $indexColumna = 1;
    public $clasificacionImpacto;
    public $nivelImpacto;
    public $colorImpacto;
    public $tablaImpacto =1;
    public $indexRow = 1;
    public $filas = [
    ];
    public $nombreImpacto;
    public $criterioImpacto;
    public $baseImpacto;


    public function mount()
    {
        $impactos= NivelesImpacto::where('tabla_impacto_id', $this->tablaImpacto)->get();
        foreach($impactos as $impacto)
        {
            $columna = [
                'nivel'=>$impacto->nivel,
                'clasificacion' => $impacto->clasificacion,
                'color' => $impacto->color,
            ];

            array_push($this->columnas, $columna);
        }
    }

    public function addColumn($indexColumna)
    {
        // dd($this->colorImpacto);
        $this->crearNivel($this->nivelImpacto, $this->clasificacionImpacto, $this->colorImpacto, $this->tablaImpacto);
        $columna = [
            'nivel'=>$this->nivelImpacto,
            'clasificacion' => $this->clasificacionImpacto,
            'color' => $this->colorImpacto,
        ];
        //  dd($columna);
        // $indexColumna=$indexColumna+1;
        $this->indexColumna = $indexColumna;
        array_push($this->columnas, $columna);
        $this->emit('cerrarModal');
    }

    public function crearNivel($nivel, $clasificacion, $color, $tabla_impacto)
    {
        $nivelImpacto=NivelesImpacto::create([
            'nivel'=>$nivel,
            'clasificacion' =>$clasificacion,
            'color'=>$color,
            'tabla_impacto_id'=>$tabla_impacto,
        ]);

        return $nivelImpacto;
    }

    public function addRow($indexRow)
    {
        $this->crearTipo($this->nombreImpacto, $this->criterioImpacto, $this->baseImpacto, $this->tablaImpactoId, $this->nivelesImpactoId)

        $fila = [
            'nombre_impacto'=>$this->nombreImpacto,
            'criterio'=> $this->criterioImpacto,
            'base'=>$this->baseImpacto,
        ];

        $this->indexRow = $indexRow;
        array_push($this->filas, $fila);
        $this->emit('cerrarModalImpacto');
    }

    public function crearTipo($nombre, $criterio, $base, $niveles_impacto, $tabla_impacto)
    {

        $tipoImpacto=TipoImpacto::create([
            'nombre_impacto'=>$nombre,
            'criterio'=> $criterio,
            'base'=>$base,
            'niveles_impacto_id'=>$niveles_impacto,
            'tabla_impacto_id'=>$tabla_impacto,

        ]);

        return  $tipoImpacto;
    }


    public function render()
    {

        return view('livewire.tabla-impacto');
    }
}
