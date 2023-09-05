<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\Empleado;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Sede;
use App\Models\SubcategoriaActivo;
use App\Models\Tipoactivo;
use Maatwebsite\Excel\Concerns\ToModel;

class ActivoImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Activo([
            'nombreactivo' => $row[0],
            'tipoactivo_id' => $this->obtenerCategoriaPorNombre($row[1]),
            'subtipo_id' => $this->obtenerSubcategoriaPorNombre($row[2]),
            'descripcion' => $row[3],
            'dueno_id' => $this->obtenerDuenoPorId($row[4]),
            'id_responsable' => $this->obtenerResponsablePorId($row[5]),
            // 'ubicacion_id' => $this->obtenerUbicacionPorId($row[6]),
            'sede' => $row[6],
            // 'marca' => $row[7],
            // 'modelo' => $row[9],
            'n_serie' => $row[7],
            'n_producto' => $row[8],
            // 'fecha_alta' => $row[9],
            // 'fecha_compra' => $row[13],
            // 'fecha_fin' => $row[14],
            // 'fecha_baja' => $row[15],
            // 'observaciones' => $row[16],
        ]);
    }

    // public function obtenerCategoriaPorId($categoria)
    // {
    //     // dd($categoria);
    //     $categoria_bd = Tipoactivo::select('id', 'tipo')->where('id', $categoria)->first();
    //     // dd($categoria_bd);
    //     return $categoria_bd->id;
    // }

    public function obtenerCategoriaPorNombre($nombre)
    {
        $tipoactivos_bd = Tipoactivo::select('id', 'tipo')->where('tipo', $nombre)->first();
        if ($tipoactivos_bd) {
            return $tipoactivos_bd->id;
        }

        return null;
    }

    public function obtenerSubcategoriaPorNombre($nombre)
    {
        $subcategoria_activos_bd = SubcategoriaActivo::select('id', 'subcategoria')->where('subcategoria', $nombre)->first();

        if ($subcategoria_activos_bd) {
            return $subcategoria_activos_bd->id;
        }

        return null;
    }

    // public function obtenerSubCategoriaPorId($subcategoria)
    // {
    //     $subcategoria_activos_bd = Tipoactivo::select('id', 'subtipo')->where('id', $subcategoria)->first();
    //     // dd( $subcategoria_bd);
    //     return $subcategoria_activos_bd->id;
    // }

    public function obtenerDuenoPorId($dueno)
    {
        $dueno_bd = Empleado::alta()->select('id', 'name')->where('id', $dueno)->first();
        if ($dueno_bd) {
            return $dueno_bd->id;
        }

        return null;
    }

    public function obtenerResponsablePorId($responsable)
    {
        $responsable_bd = Empleado::alta()->select('id', 'name')->where('id', $responsable)->first();
        if ($responsable_bd) {
            return $responsable_bd->id;
        }

        return null;
    }

    public function obtenerUbicacionPorId($ubicacion)
    {
        $ubicacion_bd = Sede::getAll()->where('id', $ubicacion)->first();

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
