<?php

namespace App\Imports;

use App\Models\Evaluacion;
use Maatwebsite\Excel\Concerns\ToModel;

class EvaluacionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Evaluacion([
            //
        ]);
    }
}
