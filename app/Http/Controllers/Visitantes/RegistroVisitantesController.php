<?php

namespace App\Http\Controllers\Visitantes;

use App\Http\Controllers\Controller;
use App\Models\Organizacion;
use App\Models\Visitantes\RegistrarVisitante;
use App\Models\Visitantes\AvisoPrivacidadVisitante;
use App\Models\Visitantes\ResponsableVisitantes;
use App\Models\Visitantes\VisitanteQuote;
use Illuminate\Http\Request;

class RegistroVisitantesController extends Controller
{
    public $existsResponsable;
    public function __construct()
    {
        $this->existsResponsable = ResponsableVisitantes::exists();
    }
    public function presentacion()
    {
        $quote = VisitanteQuote::first();
        if (VisitanteQuote::count() > 0) {
            $quote = VisitanteQuote::first();
        } else {
            $quote = new VisitanteQuote();
        }
        $logo = asset('img/logo_monocromatico.png');
        if (Organizacion::select('id', 'logotipo')->first()) {
            $logo = Organizacion::select('id', 'logotipo')->first()->logotipo;
        }

        return view('visitantes.registro-visitantes.presentacion', compact('quote', 'logo'))->with('existsResponsable', $this->existsResponsable);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (AvisoPrivacidadVisitante::count() > 0) {
            $aviso_privacidad = AvisoPrivacidadVisitante::first();
        } else {

            $aviso_privacidad = new AvisoPrivacidadVisitante();
        }
        if (Organizacion::count() > 0) {
            $organizacionLogo = Organizacion::first()->logotipo;
        } else {
            $organizacionLogo = asset('img/logo.png');
        }

        return view('visitantes.registro-visitantes.index', compact('aviso_privacidad', 'organizacionLogo'))->with('existsResponsable', $this->existsResponsable);
    }

    public function salida()
    {

        return view('visitantes.registro-visitantes.salida')->with('existsResponsable', $this->existsResponsable);
    }

    public function registrarSalida($registrarVisitante)
    {
        $visitante = RegistrarVisitante::where('uuid', $registrarVisitante)->first();
        return view('visitantes.registro-visitantes.salida-registro', compact('visitante'))->with('existsResponsable', $this->existsResponsable);
    }
}
