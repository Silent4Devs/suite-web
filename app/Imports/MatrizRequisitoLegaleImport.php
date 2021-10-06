<?php

namespace App\Imports;

use App\Models\MatrizRequisitoLegale;
use Maatwebsite\Excel\Concerns\ToModel;

class MatrizRequisitoLegaleImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MatrizRequisitoLegale([
            //
        ]);
    }
}
