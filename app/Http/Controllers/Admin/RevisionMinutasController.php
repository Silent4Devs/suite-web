<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Minutasaltadireccion;
use App\Models\RevisionMinuta;

class RevisionMinutasController extends Controller
{
    public function edit(RevisionMinuta $revisionMinuta)
    {
        $minuta = Minutasaltadireccion::find(intval($revisionMinuta->minuta_id));
        if (! $minuta) {
            abort_if(! $minuta, 404);
        }
        $empleado = Empleado::find(intval($revisionMinuta->empleado_id));

        return view('externos.minutas.revisiones.edit', compact('minuta', 'empleado', 'revisionMinuta'));
    }
}
