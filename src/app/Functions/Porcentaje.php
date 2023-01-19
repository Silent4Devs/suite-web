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

    public function GapDosPorc($total,  $gap2inexistente,$gap2inicial,$gap2repetible,  $gap2definida, $gap2administrada, $gap2optimizada)
    {
        $valor = 40/$total;
       
        $inexistente=  $gap2inexistente * $valor;
        $inicial= $gap2inicial * $valor;
        $repetible= $gap2repetible * $valor;
        $definida=  $gap2definida * $valor;
        $administrada= $gap2administrada * $valor;
        $optimizada= $gap2optimizada * $valor;
        // dd($gap2satisfactorio);
        //$parcialmenteValor = $gap2parcialmente * ($valor / 2);
        $porcentaje = $inexistente +  $inicial + $repetible +  $definida + $administrada + $optimizada * (100) / 40;
        
        $avance = (($inexistente +  $inicial + $repetible +  $definida + $administrada + $optimizada) *$porcentaje) /100;
        // dd($valor, $total, $inexistente, $inicial,  $repetible,$definida,$administrada, $optimizada);
        // $avance= 68;
        
        return [
            // 'Gap2Satis' => $satisfactoriamente,
           // 'Gap2Parcial' => $parcialmenteValor,
            'Porcentaje' => $porcentaje,
            'Avance' => $avance,
            
        ];
    }//termina func

    public function GapTresPorc($totaltres,$gap3porcentaje, $gap32porcentaje, $gap3optimizada,$gap3administrada, $gap3definida, $gap3repetible, $gap3inicial,$gap3inexistente)
    {
       

        $valor = 30/$totaltres;
        $inexistente=  $gap3inexistente * $valor;
        $inicial= $gap3inicial * $valor;
        $repetible= $gap3repetible * $valor;
        $definida=  $gap3definida * $valor;
        $administrada= $gap3administrada * $valor;
        $optimizada= $gap3optimizada * $valor;
        $resultado = ($inexistente +  $inicial + $repetible +  $definida + $administrada + $optimizada * 100) / 30 ;
        $avance = (($inexistente +  $inicial + $repetible +  $definida + $administrada + $optimizada) *$resultado) /100;
        $resultadoporcentaje=round($resultado *(30)/100);
        // dd($resultadoporcentaje, $avance, $resultado);

        //$porc2 = (round($gap12cont) * 20) / 100;
        return [
            'porcentaje' => round($resultado *(30)/100),
            'verificar' => $resultado,

        ];
    }//termina func
}
