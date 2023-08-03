<?php

namespace App\Imports;

use App\Models\Competencia;
use Maatwebsite\Excel\Concerns\ToModel;

class CompetenciaImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Competencia([
            //
        ]);
    }
}
