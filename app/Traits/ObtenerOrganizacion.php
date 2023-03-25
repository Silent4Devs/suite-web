<?php

namespace App\Traits;

use App\Models\Organizacion;

trait ObtenerOrganizacion
{
    public function obtenerOrganizacion()
    {
        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;
        $organizacion = (object) [
            'logo' => $logo_actual,
            'empresa' => $empresa_actual,
        ];

        return $organizacion;
    }
}
