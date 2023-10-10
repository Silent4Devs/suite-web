<?php

namespace App\Imports;

use App\Models\Empleado;
use App\Models\Minutasaltadireccion;
use Maatwebsite\Excel\Concerns\ToModel;

class MinutasaltadireccionImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Minutasaltadireccion([
            'objetivoreunion' => $row[0],
            'fechareunion' => $row[1],
            // 'hora_inicio' => $row[2],
            // 'hora_termino' => $row[3],
            'tema_reunion' => $row[2],
            'tema_tratado' => $row[3],
            'estatus' => $this->obtenerEstatusPorTexto($row[4]),
            'responsable_id' => $this->obtenerResponsablePorNombre($row[5]),

        ]);
    }

    public function obtenerEstatusPorTexto($texto)
    {
        switch (trim(strtolower($texto))) {
            case 'en elaboracion':
                return Minutasaltadireccion::EN_ELABORACION;
                break;
            case 'en revision':
                return Minutasaltadireccion::EN_REVISION;
                break;
            case 'publicado':
                return Minutasaltadireccion::PUBLICADO;
                break;
            case 'documento rechazado':
                return Minutasaltadireccion::DOCUMENTO_RECHAZADO;
                break;
            default:
                return Minutasaltadireccion::EN_ELABORACION;
                break;
        }
    }

    public function obtenerResponsablePorNombre($nombre)
    {
        $empleado_bd = Empleado::alta()->select('id', 'name')->where('name', $nombre)->first();

        if ($empleado_bd) {
            return $empleado_bd->id;
        }

        return null;
    }
}
