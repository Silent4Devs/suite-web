<?php

namespace App\Imports;

use App\Models\FaqQuestion;
use Maatwebsite\Excel\Concerns\ToModel;

class FaqPreguntaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FaqQuestion([
            'question' => $row[0],
        ]);
    }
}
