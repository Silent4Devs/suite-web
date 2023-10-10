<?php

namespace App\Imports;

use App\Models\Empleado;
use App\Models\PoliticaSgsi;
use Maatwebsite\Excel\Concerns\ToModel;

class PoliticaSgsiImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PoliticaSgsi([
            'politicasgsi' => $row[0],
            'fecha_publicacion' => $row[1],
            'fecha_entrada' => $row[2],
            'fecha_revision' => $row[3],
            'id_reviso_politica' => $this->obtenerEmpleadoPorNombre($row[4]),
        ]);
    }

    public function rules(): array
    {
        return [
            'politicasgsi' => 'required|string|min:2|max:255',
            'fecha_publicacion' => 'required|date',
            'fecha_entrada' => 'required|date',
            'fecha_revision' => 'required|date',

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
