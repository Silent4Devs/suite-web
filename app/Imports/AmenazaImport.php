<?php

namespace App\Imports;

use App\Models\Amenaza;
use Maatwebsite\Excel\Concerns\ToModel;

class AmenazaImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Amenaza([
            'nombre' => $row[0],
            'categoria' => $row[1],
            'descripcion' => $row[2],
        ]);
    }
}
