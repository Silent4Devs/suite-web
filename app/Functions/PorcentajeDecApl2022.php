<?php

namespace App\Functions;

class PorcentajeDecApl2022
{
    public function GapDecAplPorc($total, $conteoAprobado)
    {
        $valor = 100 / $total;

        $aprobada = $conteoAprobado * $valor;

        $porcentaje = number_format($aprobada, 2);
        $faltante = number_format((100 - $porcentaje), 2);

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
