<?php

namespace App\Imports;

use App\Models\AlcanceSgsi;
use Maatwebsite\Excel\Concerns\ToModel;

class AlcanceSgsiImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AlcanceSgsi([
            //
        ]);
    }
}
