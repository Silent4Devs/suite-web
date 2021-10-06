<?php

namespace App\Imports;

use App\Models\EstadoIncidente;
use Maatwebsite\Excel\Concerns\ToModel;

class EstadoIncidenteImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new EstadoIncidente([
            'estado' => $row[0],
        ]);
    }
}
