<?php

namespace App\Imports;

use App\Models\Empleado;
use App\Models\EntendimientoOrganizacion;
use Maatwebsite\Excel\Concerns\ToModel;

class EntendimientoOrganizacionImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new EntendimientoOrganizacion([
            'analisis' => $row[0],
            'fecha' => $row[1],
            'id_elabora' => $this->obtenerEmpleadoPorNombre($row[2]),
            'fortalezas' => $row[3],
            'oportunidades' => $row[4],
            'debilidades' => $row[5],
            'amenazas' => $row[6],
        ]);
    }

    public function rules(): array
    {
        return [
            'analisis' => 'required|string|min:2|max:255',
            'fecha' => 'required|date',
            'fortalezas' => 'required|string|min:2|max:255',
            'oportunidades' => 'required|string|min:1|max:255',
            'debilidades' => 'required|string|min:1|max:255',
            'amenazas' => 'required|string|min:1|max:255',
        ];
    }

    public function obtenerEmpleadoPorNombre($nombre)
    {
        // dd($nombre);
        $empleado_bd = Empleado::alta()->select('id', 'name')->where('name', $nombre)->first();
        dd($empleado_bd);

        return $empleado_bd->id;
    }
}
