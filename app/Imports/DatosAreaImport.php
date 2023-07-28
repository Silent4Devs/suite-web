<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Grupo;
use Maatwebsite\Excel\Concerns\ToModel;

class DatosAreaImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Area([
            'area' => $row[0],
            'id_reporta' => $this->obtenerReportaPorNombre($row[1]),
            'id_grupo' => $this->obtenerGrupoPorNombre($row[2]),
            'descripcion' => $row[3],
        ]);
    }

    public function rules(): array
    {
        return [
            'area' => 'required|string|min:2|max:255',
            'descripcion' => 'required|string|min:2|max:255',
        ];
    }

    public function obtenerReportaPorNombre($reporta)
    {
        $area_bd = Area::select('id', 'area')->where('area', $reporta)->first();

        return $area_bd->id;
    }

    public function obtenerGrupoPorNombre($grupo)
    {
        $grupo_bd = Grupo::select('id', 'nombre')->where('nombre', $grupo)->first();

        return $grupo_bd->id;
    }
}
