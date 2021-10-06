<?php

namespace App\Imports;

use App\Models\AnalisisDeRiesgo;
use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\ToModel;

class AnalisisDeRiesgoImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AnalisisDeRiesgo([
            'nombre' => $row[0],
            'tipo' => $row[1],
            'fecha'=> $row[2],
            'porcentaje_implementacion'=> $row[3],
            'id_elaboro'=> $this->obtenerEmpleadoPorNombre($row[4]),
            'estatus'=> array_keys($this->obtenerIdEstatusPorTexto($row[5]))[0],
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|min:2|max:255',
            'tipo' => 'required|string|min:2|max:255',
            'fecha' => 'required|date',
            'porcentaje_implementacion' => 'required|string|min:1|max:255',
        ];
    }

    public function obtenerIdEstatusPorTexto($estatus)
    {
        $estatusId = AnalisisDeRiesgo::EstatusSelect;
        $estatus_filtrado = array_filter($estatusId, function ($item) use ($estatus) {
            return strtolower($item) == strtolower($estatus);
        });

        return $estatus_filtrado;
    }

    public function obtenerEmpleadoPorNombre($nombre)
    {
        $empleado_bd = Empleado::select('id', 'name')->where('name', $nombre)->first();

        return $empleado_bd->id;
    }
}
