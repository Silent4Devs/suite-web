<?php

namespace App\Imports;

use App\Models\EnlacesEjecutar;
use Maatwebsite\Excel\Concerns\ToModel;

class EjecutarenlaceImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new EnlacesEjecutar([
            'ejecutar' => $row[0],
            'descripcion' => $row[1],
            'enlace' => $row[2],
        ]);
    }
}
