<?php

namespace App\Imports;

use App\Models\Controle;
use Maatwebsite\Excel\Concerns\ToModel;

class ControlImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Controle([
            'numero' => $row[0],
            'control' => $row[1],
        ]);
    }
}
