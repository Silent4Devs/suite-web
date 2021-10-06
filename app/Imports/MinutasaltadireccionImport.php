<?php

namespace App\Imports;

use App\Models\Minutasaltadireccion;
use Maatwebsite\Excel\Concerns\ToModel;

class MinutasaltadireccionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Minutasaltadireccion([
            //
        ]);
    }
}
