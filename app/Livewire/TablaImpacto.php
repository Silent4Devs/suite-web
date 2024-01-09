<?php

namespace App\Livewire;

use App\Models\NivelesImpacto;
use App\Models\TipoImpacto;
use App\Models\TipoNivelImpacto;
use Livewire\Component;

class TablaImpacto extends Component
{
    public $columnas = [
    ];

    public $indexColumna = 1;

    public $clasificacionImpacto;

    public $nivelImpacto;

    public $colorImpacto;

    public $tablaImpacto = 1;

    protected $rules = [
        'nivelImpacto' => 'required|numeric|min:0',
        'clasificacionImpacto' => 'required|string|max:255',
        'colorImpacto' => 'required',
    ];

    public $filas = [
    ];

    public $indexRow = 1;

    public $nombreImpacto;

    public $criterioImpacto;

    public $baseImpacto;

    public $tablaImpactoId = 1;
    // public $contenidos =[];

    public function mount()
    {

    }

    // public function addColumn($indexColumna)
    // {
    //     // dd($this->colorImpacto);
    //     $this->crearNivel($this->nivelImpacto, $this->clasificacionImpacto, $this->colorImpacto, $this->tablaImpacto);
    //     $impactos= NivelesImpacto::where('tabla_impacto_id', $this->tablaImpacto)->get();
    //     foreach($impactos as $impacto)
    //     {
    //         $columna = [
    //             'id'=>$impacto->id,
    //             'nivel'=>$impacto->nivel,
    //             'clasificacion' => $impacto->clasificacion,
    //             'color' => $impacto->color,
    //         ];

    //         array_push($this->columnas, $columna);
    //     }

    //     $tipoImpactos= TipoImpacto::where('tabla_impacto_id', $this->tablaImpacto)->get();
    //     foreach($tipoImpactos as $tipoImpacto){
    //         $fila = [
    //             'id'=>$tipoImpacto->id,
    //             'nombre_impacto'=>$tipoImpacto->nombre_impacto,
    //             'criterio'=> $tipoImpacto->criterio,
    //             'base'=>$tipoImpacto->base,
    //         ];

    //         array_push($this->filas, $fila);
    //     }
    // }

    public function addColumn($indexColumna)
    {
        // dd($this->colorImpacto);
        $this->validate();
        $nivelCreado = $this->crearNivel($this->nivelImpacto, $this->clasificacionImpacto, $this->colorImpacto, $this->tablaImpacto);
        $columna = [
            'id' => $nivelCreado->id,
            'nivel' => $this->nivelImpacto,
            'clasificacion' => $this->clasificacionImpacto,
            'color' => $this->colorImpacto,
        ];
        //  dd($columna);
        // $indexColumna=$indexColumna+1;
        $this->indexColumna = $indexColumna;
        array_push($this->columnas, $columna);
        $this->dispatch('cerrarModal');
        $this->reset(['nivelImpacto', 'clasificacionImpacto', 'colorImpacto']);
    }

    public function crearNivel($nivel, $clasificacion, $color, $tabla_impacto)
    {
        $nivelImpacto = NivelesImpacto::create([
            'nivel' => $nivel,
            'clasificacion' => $clasificacion,
            'color' => $color,
            'tabla_impacto_id' => $tabla_impacto,
        ]);

        return $nivelImpacto;
    }

    public function addRow($indexRow)
    {
        $tipoCreado = $this->crearTipo($this->nombreImpacto, $this->criterioImpacto, $this->baseImpacto, $this->tablaImpactoId);

        // dd($fila);
        $impactos = NivelesImpacto::where('tabla_impacto_id', $this->tablaImpacto)->get();
        foreach ($impactos as $impacto) {
            $this->contenidos["i{$impacto->id}"]["t{$tipoCreado->id}"] = ['contenido' => ''];
        }
        $fila = [
            'id' => $tipoCreado->id,
            'nombre_impacto' => $this->nombreImpacto,
            'criterio' => $this->criterioImpacto,
            'base' => $this->baseImpacto,
        ];
        $this->indexRow = $indexRow;
        array_push($this->filas, $fila);

        $this->dispatch('cerrarModalImpacto');
        $this->reset(['nombreImpacto', 'criterioImpacto', 'baseImpacto']);
    }

    public function crearTipo($nombre, $criterio, $base, $tabla_impacto)
    {
        $tipoImpacto = TipoImpacto::create([
            'nombre_impacto' => $nombre,
            'criterio' => $criterio,
            'base' => $base,
            'tabla_impacto_id' => $tabla_impacto,

        ]);
        $this->dispatch('cerrarModalImpacto');

        return $tipoImpacto;
    }

    public function guardarContenido($tipo, $nivel, $contenido)
    {
        //Guarda el contenido sino hay un registro existente de eso, en caso de haber sólo lo actualiza
        $tipoNivel = TipoNivelImpacto::updateOrCreate(['tipo_impacto_id' => $tipo, 'niveles_impacto_id' => $nivel], ['contenido' => $contenido]);

        return $tipoNivel;
    }

    public function obtenerContenido($tipo, $nivel)
    {
        $contenido = TipoNivelImpacto::select('id', 'contenido')->where('tipo_impacto_id', $tipo)->where('niveles_impacto_id', $nivel)->first();
        if ($contenido == null) {
            return null;
        }

        return $contenido;
    }

    public function render()
    {
        $tipos = TipoImpacto::where('tabla_impacto_id', $this->tablaImpacto)->get();
        $impactos = NivelesImpacto::where('tabla_impacto_id', $this->tablaImpacto)->get();
        foreach ($impactos as $index => $impacto) {
            // array_push($this->contenidos,["i{$impacto->id}"=>[]]);
            // dd($this->contenidos);
            // foreach($tipos as $tipo)
            // {
            //     $contenido = $this->obtenerContenido($tipo->id, $impacto->id);
            //     // array_push($this->contenidos[$impacto->id],['contenido'=>$contenido]);
            //     // $this->contenidos["i{$impacto->id}"]["t{$tipo->id}"]=['contenido'=>$contenido];
            // }
            $columna = [
                'id' => $impacto->id,
                'nivel' => $impacto->nivel,
                'clasificacion' => $impacto->clasificacion,
                'color' => $impacto->color,
            ];

            array_push($this->columnas, $columna);
        }
        foreach ($tipos as $tipo) {
            $fila = [
                'id' => $tipo->id,
                'nombre_impacto' => $tipo->nombre_impacto,
                'criterio' => $tipo->criterio,
                'base' => $tipo->base,
            ];

            array_push($this->filas, $fila);
        }

        return view('livewire.tabla-impacto');
    }
}
