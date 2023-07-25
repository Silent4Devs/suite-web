<?php

namespace App\Functions;

class Porcentaje2022
{
    public function GapUnoPorc($gap1porcentaje)
    {
        $valorgap1cump = 30 / 15;
        $valorgap1parc = $valorgap1cump / 2;
        $gap1cont = 0;
        foreach ($gap1porcentaje as $gap1) {
            if ($gap1->valoracion == '1') {
                $gap1cont += $valorgap1cump;
            } elseif ($gap1->valoracion == '2') {
                $gap1cont += $valorgap1parc;
            } else {
                $gap1cont += 0;
            }
        }

        $resultado = $gap1cont;
        //$porc2 = (round($gap12cont) * 20) / 100;
        return $resultado;
    }//termina func

    public function GapDosPorc($gap2porcentaje, $total, $gap2satisfactorio, $gap2parcialmente)
    {
        $valor = 40 / $total;
        $satisfactoriamente = $gap2satisfactorio * $valor;
        $parcialmenteValor = $gap2parcialmente * ($valor / 2);
        $porcentaje = ($satisfactoriamente + $parcialmenteValor) * (100) / 40;
        $avance = $satisfactoriamente + $parcialmenteValor;

        return [
            'Gap2Satis' => $satisfactoriamente,
            'Gap2Parcial' => $parcialmenteValor,
            'Porcentaje' => $porcentaje,
            'Avance' => $avance,
        ];
    }//termina func

    public function GapTresPorc(
        $gap3porcentaje,
        $gap3satisfactorios,
        $gap3parcialmente,
        $gap3asatisfactorios,
        $gap3aparcialmente
    ) {
        //Sacar el valor correspondiente
        $valor = 30 / $gap3porcentaje;
        //Valor de satisfactoriamente y de parcialmente
        $porcg3satis = $valor;
        $porcg3parc = $valor / 2;

        $gapverif = ($gap3satisfactorios * $porcg3satis) + ($gap3parcialmente * $porcg3parc);
        $gapactu = ($gap3asatisfactorios * $porcg3satis) + ($gap3aparcialmente * $porcg3parc);

        $resultado = ($gapverif + $gapactu);

        return [
            'porcentaje' => $resultado,
            'verificar' => $gapverif,
            'actuar' => $gapactu,
        ];
    }//termina func

    public function GAPTotal($porcentajeGap1, $porcentajeGap2, $porcentajeGap3)
    {
        $total = $porcentajeGap1 + $porcentajeGap2 + $porcentajeGap3;

        $total = round($total, 2);

        return $total;
    }
}
