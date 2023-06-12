<?php

namespace App\Functions;

class PorcentajeDecApl2022
{

    public function GapDecAplPorc($total, $conteoAprobado)
    {
        $valor = 100 / $total;

        $aprobada = $conteoAprobado * $valor;

        $porcentaje = $aprobada;
        $faltante = 100-$porcentaje;

        return [
            'porcentaje' => $porcentaje,
            'faltante' => $faltante,
        ];
    }//termina func

    public function GAPTotal($porcentajeGap1, $porcentajeGap2, $porcentajeGap3)
    {
        $total = $porcentajeGap1 + $porcentajeGap2 + $porcentajeGap3;

        $total = round($total, 2);

        return $total;
    }
}
