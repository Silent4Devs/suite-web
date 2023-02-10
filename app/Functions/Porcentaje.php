<?php

namespace App\Functions;

class Porcentaje
{
    public function GapUnoPorc($gap1porcentaje, $gap12porcentaje)
    {
        $gap1cont = 0;
        foreach ($gap1porcentaje as $gap1) {
            if ($gap1->valoracion == '0') {
                $gap1cont += 0;
            } elseif ($gap1->valoracion == '1') {
                $gap1cont += 1;
            } elseif ($gap1->valoracion == '2') {
                $gap1cont += 2;
            } elseif ($gap1->valoracion == '3') {
                $gap1cont += 3;
            } elseif ($gap1->valoracion == '4') {
                $gap1cont += 4;
            } elseif ($gap1->valoracion == '5') {
                $gap1cont += 5;
            } else {
                $gap1cont += 0;
            }
        }

        //$porc1 = ($gap1cont * 20) / 13;
        $gap12cont = 0;
        foreach ($gap12porcentaje as $gap12) {
            if ($gap12->valoracion == '0') {
                $gap12cont += 0;
            } elseif ($gap12->valoracion == '1') {
                $gap12cont += 1;
            } elseif ($gap12->valoracion == '2') {
                $gap12cont += 2;
            } elseif ($gap12->valoracion == '3') {
                $gap12cont += 3;
            } elseif ($gap12->valoracion == '4') {
                $gap12cont += 4;
            } elseif ($gap12->valoracion == '5') {
                $gap12cont += 5;
            } else {
                $gap12cont += 0;
            }
        }

        $resultado = $gap1cont + $gap12cont;
        //$porc2 = (round($gap12cont) * 20) / 100;
        return $resultado;
    }//termina func


    public function GapDosPorc($preguntasGap2, $puntosGap2)
    {

    
        $puntaje_maximo = $preguntasGap2 * 5;
        
        $puntaje = 0;
        foreach ($puntosGap2 as $punto) {
            if ($punto->valoracion == '0') {
                $puntaje += 0;
            } elseif ($punto->valoracion == '1') {
                $puntaje += 1;
            } elseif ($punto->valoracion == '2') {
                $puntaje += 2;
            } elseif ($punto->valoracion == '3') {
                $puntaje += 3;
            } elseif ($punto->valoracion == '4') {
                $puntaje += 4;
            } elseif ($punto->valoracion == '5') {
                $puntaje += 5;
            } else {
                $puntaje += 0;
            }
        }

        $resultado = $puntaje;

        $porcentaje_gap = ($resultado / $puntaje_maximo) * 100;
        $porcentaje_analisis = (($porcentaje_gap * 40)/100);

        return [
            'preguntas' => $preguntasGap2,
            'puntaje_maximo' => $puntaje_maximo,
            'porcentaje_gap' => $porcentaje_gap,
            'Porcentaje' => $porcentaje_analisis,
            'Avance' => $porcentaje_analisis,
        ];
    }

    public function GapTresPorc($preguntasGap3, $puntosGap3)
    {

        $puntaje_maximo = $preguntasGap3 * 5;
        
        $puntaje = 0;
        foreach ($puntosGap3 as $punto) {
            if ($punto->valoracion == '0') {
                $puntaje += 0;
            } elseif ($punto->valoracion == '1') {
                $puntaje += 1;
            } elseif ($punto->valoracion == '2') {
                $puntaje += 2;
            } elseif ($punto->valoracion == '3') {
                $puntaje += 3;
            } elseif ($punto->valoracion == '4') {
                $puntaje += 4;
            } elseif ($punto->valoracion == '5') {
                $puntaje += 5;
            } else {
                $puntaje += 0;
            }
        }

        $resultado = $puntaje;

        $porcentaje_gap = ($resultado / $puntaje_maximo) * 100;
        $porcentaje_analisis = (($porcentaje_gap * 30)/100);

        return [
        
            'porcentaje_gap' => $porcentaje_gap,
            'porcentaje' => $porcentaje_analisis,
            'verificar' => $porcentaje_analisis,
        ];
    }
    
}
