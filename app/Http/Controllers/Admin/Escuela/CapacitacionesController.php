<?php

namespace App\Http\Controllers\Admin\Escuela;

use App\Http\Controllers\Controller;

class CapacitacionesController extends Controller
{
    public function capacitacionesInicio()
    {
        return view('admin.escuela.capacitaciones-inicio');
    }
}
