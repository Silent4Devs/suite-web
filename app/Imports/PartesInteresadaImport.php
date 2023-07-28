<?php

namespace App\Imports;

use App\Models\Clausula;
use App\Models\PartesInteresada;
// use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PartesInteresadaImport implements ToCollection
{
    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {
            $partesInteresada = PartesInteresada::create([
                'parteinteresada' => $row[0],
                'requisitos' => $row[1],

            ]);
            // dd($partesInteresada);
            $partesInteresada->clausulas()->sync($this->obtenerIdClausulaPorNombre($row[2]));
        }
    }

    public function rules(): array
    {
        return [
            'parteinteresada' => 'required|string|min:2|max:255',
            'requisitos' => 'required|text|min:2|max:400',

        ];
    }

    public function obtenerIdClausulaPorNombre($nombre)
    {
        // dd($nombre);

        $clausulas = explode(',', $nombre);
        // dd($clausulas);
        $clausulas_id = [];
        foreach ($clausulas as $clausula) {
            $clausula_bd = Clausula::select('id', 'nombre')->where('nombre', $clausula)->first();
            if ($clausula_bd) {
                array_push($clausulas_id, $clausula_bd->id);
            }
        }
        // dd($clausulas_id);
        return $clausulas_id;
    }
}
