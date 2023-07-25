<?php

namespace App\Imports;

use App\Models\Vulnerabilidad;
use Maatwebsite\Excel\Concerns\ToModel;

class VulnerabilidadImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Vulnerabilidad([
            'nombre' => $row[0],
            'descripcion' => $row[1],
        ]);
    }
}
