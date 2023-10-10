<?php

namespace App\Exports;

use App\Models\Amenaza;
use Maatwebsite\Excel\Concerns\FromCollection;

class AmenazaExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Amenaza::all();
    }
}
