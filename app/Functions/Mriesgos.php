<?php

namespace App\Functions;

class Mriesgos
{
    public function CalculoD($result1)
    {
        $disp = 0;

        if ($result1->disponibilidad == 'Si') {
            $disp += 3.33;
        } else {
            $disp += 0;
        }

        $Intg = 0;
        if ($result1->integridad == 'Si') {
            $Intg += 3.33;
        } else {
            $Intg += 0;
        }

        $conf = 0;
        if ($result1->confidencialidad == 'Si') {
            $conf += 3.33;
        } else {
            $conf += 0;
        }

        $resultadoponderacion = $disp + $Intg + $conf;

        return $resultadoponderacion;
    }
}
