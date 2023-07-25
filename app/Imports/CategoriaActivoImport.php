<?php

namespace App\Imports;

use App\Models\Tipoactivo;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoriaActivoImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Tipoactivo([
            'tipo' => $row[0],
            'subtipo' => $row[1],
        ]);
    }
}
