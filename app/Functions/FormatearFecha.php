<?php

namespace App\Functions;

use Carbon\Carbon;

class FormatearFecha
{
    /**
     * formatearFecha es una funcion que se ayuda de carbon y formatea fechas según el formato que se requiera.
     *
     * @param formatoInicial string example 'd-m-Y'
     * @param formatoRequerido string example 'Y-m-d'
     * @other format example Y-m-d H:i:s.u
     *
     * @return Fecha con nuevo formato
     */
    public function formatearFecha($fecha, $formatoInicial, $formatoRequerido)
    {
        try {
            $fecha = Carbon::parse($fecha)->format('d-m-Y');
            // dd($formatoInicial, $fecha);
            $formF = Carbon::createFromFormat($formatoInicial, $fecha)
            ->format($formatoRequerido);

            return $formF;
        } catch (Throwable $e) {
            report($e);

            return $formfecha;
        }
    }
}
