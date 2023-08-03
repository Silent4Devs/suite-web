<?php

namespace App\Imports;

use App\Models\Grupo;
use Maatwebsite\Excel\Concerns\ToModel;

class GrupoImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Grupo([
            'nombre' => $row[0],
            'descripcion' => $row[1],
            'color' => $row[2],
        ]);
    }
}
