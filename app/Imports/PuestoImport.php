<?php

namespace App\Imports;

use App\Models\Puesto;
use Maatwebsite\Excel\Concerns\ToModel;

class PuestoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Puesto([
            'puesto' => $row[0],
            'descripcion' => $row[1],
        ]);
    }
}
