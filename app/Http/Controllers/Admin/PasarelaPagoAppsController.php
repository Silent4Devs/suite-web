<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasarelaPagoAppsController extends Controller
{
    public function capacitaciones()
    {

        return view('admin.pasarelaPago.apps.capacitaciones');
    }

    public function gestionNormativa()
    {

        return view('admin.pasarelaPago.apps.gestion-normativa');
    }

    public function planesTrabajo()
    {

        return view('admin.pasarelaPago.apps.planes-trabajo');
    }

    public function gestionDocumental()
    {

        return view('admin.pasarelaPago.apps.gestion-documental');
    }

    public function gestionTalento()
    {

        return view('admin.pasarelaPago.apps.gestion-talento');
    }

    public function gestionContractual()
    {

        return view('admin.pasarelaPago.apps.gestion-contractual');
    }

    public function gestionRiesgos()
    {

        return view('admin.pasarelaPago.apps.gestion-riesgos');
    }

    public function visitantes()
    {

        return view('admin.pasarelaPago.apps.visitantes');
    }
}
