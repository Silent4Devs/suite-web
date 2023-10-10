<?php

namespace App\Imports;

use App\Models\Empleado;
use App\Models\MatrizRequisitoLegale;
use Maatwebsite\Excel\Concerns\ToModel;

class MatrizRequisitoLegaleImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MatrizRequisitoLegale([
            'tipo' => array_keys($this->obtenerIdTipoPorTexto($row[0]))[0],
            'nombrerequisito' => $row[1],
            'formacumple' => $row[2],
            'requisitoacumplir' => $row[3],
            'medio' => $row[4],
            'fechaexpedicion' => $row[5],
            'fechavigor' => $row[6],
            'periodicidad_cumplimiento' => array_keys($this->obtenerIdPCPorTexto($row[7]))[0],
            'cumplerequisito' => $row[8],
            'id_reviso' => $this->obtenerEmpleadoPorNombre($row[9]),
            'puesto' => $row[10],
            'area' => $row[11],

        ]);
    }

    public function rules(): array
    {
        return [
            'nombrerequisito' => 'required|string|min:2|max:255',
            'formacumple' => 'required|text|min:2|max:400',
            'requisitoacumplir' => 'required|text|min:2|max:400',
            'medio' => 'required|string|min:2|max:255',
            'fechaexpedicion' => 'required|date',
            'fechavigor' => 'required|date',
            'cumplerequisito' => 'required|string|min:2|max:255',
        ];
    }

    public function obtenerIdTipoPorTexto($tipo)
    {
        $tipoId = MatrizRequisitoLegale::TIPO_SELECT;
        $tipo_filtrado = array_filter($tipoId, function ($item) use ($tipo) {
            return strtolower($item) == strtolower($tipo);
        });

        return $tipo_filtrado;
    }

    public function obtenerIdPCPorTexto($periodicidad)
    {
        $periodicidadId = MatrizRequisitoLegale::PERIODICIDAD_SELECT;
        $periodicidad_filtrado = array_filter($periodicidadId, function ($item) use ($periodicidad) {
            return strtolower($item) == strtolower($periodicidad);
        });

        return $periodicidad_filtrado;
    }

    public function obtenerIdCRPorTexto($cumplimiento)
    {
        $cumplimientoId = MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT;
        $cumplimiento_filtrado = array_filter($cumplimientoId, function ($item) use ($cumplimiento) {
            return strtolower($item) == strtolower($cumplimiento);
        });
        dd($cumplimiento_filtrado);
    }

    public function obtenerEmpleadoPorNombre($nombre)
    {
        $empleado_bd = Empleado::alta()->select('id', 'name')->where('name', $nombre)->first();

        return $empleado_bd->id;
    }
}
