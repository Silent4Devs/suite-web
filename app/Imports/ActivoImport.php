<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\Tipoactivo;
use App\Models\Empleado;
use App\Models\Sede;
use App\Models\Marca;
use App\Models\Modelo;
use Maatwebsite\Excel\Concerns\ToModel;

class ActivoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Activo([
            'nombreactivo' => $row[0],
            'tipoactivo_id' => $this->obtenerCategoriaPorId($row[1]),
            'subtipo_id' => $this->obtenerSubCategoriaPorId($row[2]),
            'descripcion' => $row[3],
            'dueno_id' => $this->obtenerDuenoPorId($row[4]),
            'id_responsable' => $this->obtenerResponsablePorId($row[5]),
            'ubicacion_id' => $this->obtenerUbicacionPorId($row[6]),
            'sede' => $row[7],
            'marca' => $this->obtenerMarcaPorId($row[8]),
            'modelo' => $this->obtenerModeloPorId($row[9]),
            'n_serie' => $row[10],
            'n_producto' => $row[11],
            'fecha_alta' => $row[12],
            'fecha_compra' => $row[13],
            'fecha_fin' => $row[14],
            'fecha_baja' => $row[15],
            'observaciones' => $row[16],
        
        ]);
    }
    public function obtenerCategoriaPorId($categoria)
    {
        $categoria_bd = Tipoactivo::select('id','tipo')->where('id', $categoria)->first();
        // dd($categoria_bd);
        return $categoria_bd->id;
    }
    public function obtenerSubCategoriaPorId($subcategoria)
    {
        $subcategoria_bd = Tipoactivo::select('id','subtipo')->where('id', $subcategoria)->first();
        // dd( $subcategoria_bd);
        return $subcategoria_bd->id;
    }
    public function obtenerDuenoPorId($dueno)
    {
        $dueno_bd = Empleado::select('id', 'name')->where('id', $dueno)->first();
        // dd($dueno_bd);
        return $dueno_bd->id;
    }
    public function obtenerResponsablePorId($responsable)
    {
        $responsable_bd = Empleado::select('id', 'name')->where('id', $responsable)->first();
        //  dd($responsable_bd);
        return $responsable_bd->id;
    }
    public function obtenerUbicacionPorId($ubicacion)
    {
        $ubicacion_bd = Sede::select('id', 'sede')->where('id', $ubicacion)->first();
        // dd($ubicacion_bd);
        return $ubicacion_bd->id;
    }
    public function obtenerMarcaPorId($marca)
    {
        $marca_bd = Marca::select('id', 'nombre')->where('id', $marca)->first();
        // dd($marca_bd);
        return $marca_bd->id;
    }
    public function obtenerModeloPorId($modelo)
    {
        $modelo_bd = Modelo::select('id', 'nombre')->where('id', $modelo)->first();
        // dd($modelo_bd);
        return $modelo_bd->id;
    }
}
