<?php

namespace App\Imports;

use App\Models\CategoriaCapacitacion;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoriaCapacitacionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CategoriaCapacitacion([

                'nombre' => $row[0],
        ]);
    }
}
