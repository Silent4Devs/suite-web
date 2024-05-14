<?php

namespace App\Traits;

use App\Models\Organizacion;

trait ObtenerOrganizacion
{
    public function obtenerOrganizacion()
    {
        $organizacion_actual = Organizacion::getFirst();
        if (is_null($organizacion_actual)) {
            $logo_actual = 'img/logo.png';
            $empresa_actual = 'Silent4Business';
        } else {
            $logo_actual = $organizacion_actual->logotipo;
            $empresa_actual = $organizacion_actual->empresa;
            $direccion = $organizacion_actual->direccion;
            $rfc = $organizacion_actual->rfc;
        }

        $organizacion = (object) [
            'direccion' => $direccion,
            'logo' => $logo_actual,
            'empresa' => $empresa_actual,
            'rfc' => $rfc,
        ];

        return $organizacion;
    }
}
