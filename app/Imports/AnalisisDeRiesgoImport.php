<?php

namespace App\Imports;

use App\Models\AnalisisDeRiesgo;
use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\ToModel;

class AnalisisDeRiesgoImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AnalisisDeRiesgo([
            'nombre' => $row[0],
            'tipo' => $row[1],
            'fecha' => $row[2],
            'porcentaje_implementacion' => $row[3],
            'id_elaboro' => $row[4],
            // 'id_elaboro'=> $this->obtenerEmpleadoPorNumero($row[4]),
            'estatus' => $row[5],
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

    public function obtenerEmpleadoPorNombre($nombre)
    {
        $empleado_bd = Empleado::alta()->select('id', 'name')->where('name', $nombre)->first();

        return $empleado_bd->id;
    }

    public function obtenerEmpleadoPorNumero($numero)
    {
        $empleado_bd = Empleado::alta()->select('id', 'name')->where('n_empleado', trim($numero))->first();

        return $empleado_bd->id;
    }
}
