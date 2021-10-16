<?php

namespace App\Functions;

class Porcentaje
{
    public function GapUnoPorc($gap1porcentaje, $gap12porcentaje)
    {
        $gap1cont = 0;
        foreach ($gap1porcentaje as $gap1) {
            if ($gap1->valoracion == '1') {
                $gap1cont += 5;
            } elseif ($gap1->valoracion == '2') {
                $gap1cont += 0;
            } else {
                $gap1cont += 0;
            }
        }

        //$porc1 = ($gap1cont * 20) / 13;
        $gap12cont = 0;
        foreach ($gap12porcentaje as $gap12) {
            if ($gap12->valoracion == '1') {
                $gap12cont += 1.538461538;
            } elseif ($gap12->valoracion == '2') {
                $gap12cont += 0.769230769;
            } else {
                $gap12cont += 0;
            }
        }



        $resultado = $gap1cont + $gap12cont;
        //$porc2 = (round($gap12cont) * 20) / 100;
        return $resultado;
    }//termina func

    public function GapDosPorc($gap1porcentaje, $total, $gap2satisfactorio, $gap2parcialmente)
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

    public function GapTresPorc($gap3porcentaje, $gap32porcentaje)
    {
        $gap1cont = 0;
        foreach ($gap3porcentaje as $gap1) {
            if ($gap1->valoracion == '1') {
                $gap1cont += 2.5;
            } elseif ($gap1->valoracion == '2') {
                $gap1cont += 1.25;
            } else {
                $gap1cont += 0;
            }
        }
        //$porc1 = ($gap1cont * 20) / 13;
        $gap12cont = 0;
        foreach ($gap32porcentaje as $gap12) {
            if ($gap12->valoracion == '1') {
                $gap12cont += 2.5;
            } elseif ($gap12->valoracion == '2') {
                $gap12cont += 1.25;
            } else {
                $gap12cont += 0;
            }
        }

        $resultado = $gap1cont + $gap12cont;
        //$porc2 = (round($gap12cont) * 20) / 100;
        return [
            'porcentaje' => $resultado,
            'verificar' => $gap1cont,
            'actuar' => $gap12cont,
        ];
    }//termina func
}
