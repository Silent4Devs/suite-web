<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitantes\AvisoPrivacidadVisitante;
use App\Models\Visitantes\RegistrarVisitante;
use App\Models\Visitantes\ResponsableVisitantes;
use App\Models\Visitantes\VisitanteQuote;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class VisitantesController extends Controller
{
    public function menu()
    {
        abort_if(Gate::denies('visitantes_administrador'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $existsResponsable = ResponsableVisitantes::exists();
        $existsAvisoPrivacidad = AvisoPrivacidadVisitante::exists();
        $existsCitaTextual = VisitanteQuote::exists();
        $cantidadAutorizacion = RegistrarVisitante::where('registro_salida', true)->count();

        return view('admin.visitantes.menu', compact('existsResponsable', 'cantidadAutorizacion', 'existsAvisoPrivacidad', 'existsCitaTextual'));
    }

    public function index()
    {
        abort_if(Gate::denies('visitantes_administrador'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $existsResponsable = ResponsableVisitantes::exists();

        return view('admin.visitantes.index', compact('existsResponsable'));
    }

    public function dashboard()
    {
        abort_if(Gate::denies('visitantes_administrador'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.visitantes.dashboard');
    }

    public function autorizar()
    {
        abort_if(Gate::denies('visitantes_administrador'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $existsResponsable = ResponsableVisitantes::exists();

        return view('admin.visitantes.autorizar', compact('existsResponsable'));
    }

    public function configuracion()
    {
        abort_if(Gate::denies('visitantes_administrador'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.visitantes.configuracion');
    }
}
