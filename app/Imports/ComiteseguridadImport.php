<?php

namespace App\Imports;

use App\Models\Comiteseguridad;
use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\ToModel;

class ComiteseguridadImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Comiteseguridad([
            'nombrerol' => $row[0],
            'fechavigor' => $row[1],
            'id_asignada' => $this->obtenerEmpleadoPorNombre($row[2]),
            'responsabilidades' => $row[3],
        ]);
    }

    public function rules(): array
    {
        return [
            'nombrerol' => 'required|string|min:2|max:255',
            'responsabilidades' => 'required|string|min:2|max:255',
            'fechavigor' => 'required|date',

        ];
    }

    public function obtenerEmpleadoPorNombre($nombre)
    {
        $empleado_bd = Empleado::alta()->select('id', 'name')->where('name', $nombre)->first();

        if ($empleado_bd) {
            return $empleado_bd->id;
        }

        return null;
    }
}
