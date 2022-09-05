<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitantes\AvisoPrivacidadVisitante;
use App\Models\Visitantes\RegistrarVisitante;
use App\Models\Visitantes\ResponsableVisitantes;
use App\Models\Visitantes\VisitanteQuote;
use Illuminate\Http\Request;

class VisitantesController extends Controller
{
    public function menu()
    {
        $existsResponsable = ResponsableVisitantes::exists();
        $existsAvisoPrivacidad = AvisoPrivacidadVisitante::exists();
        $existsCitaTextual = VisitanteQuote::exists();
        $cantidadAutorizacion = RegistrarVisitante::where('registro_salida', true)->count();
        return view('admin.visitantes.menu', compact('existsResponsable', 'cantidadAutorizacion', 'existsAvisoPrivacidad', 'existsCitaTextual'));
    }

    public function index()
    {
        $existsResponsable = ResponsableVisitantes::exists();
        return view('admin.visitantes.index', compact('existsResponsable'));
    }

    public function dashboard()
    {
        return view('admin.visitantes.dashboard');
    }

    public function autorizar()
    {
        $existsResponsable = ResponsableVisitantes::exists();
        return view('admin.visitantes.autorizar', compact('existsResponsable'));
    }

    public function configuracion()
    {
        return view('admin.visitantes.configuracion');
    }
}
