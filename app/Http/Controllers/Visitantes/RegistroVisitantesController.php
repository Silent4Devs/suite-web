<?php

namespace App\Http\Controllers\Visitantes;

use App\Http\Controllers\Controller;
use App\Models\Organizacion;
use App\Models\Visitantes\RegistrarVisitante;
use App\Models\Visitantes\AvisoPrivacidadVisitante;
use App\Models\Visitantes\VisitanteQuote;
use Illuminate\Http\Request;

class RegistroVisitantesController extends Controller
{
    public function presentacion()
    {
        $quote = VisitanteQuote::first();
        if (VisitanteQuote::count() > 0) {
            $quote = VisitanteQuote::first();
        } else {
            $quote = new VisitanteQuote();
        }
        return view('visitantes.registro-visitantes.presentacion', compact('quote'));
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

        return view('visitantes.registro-visitantes.index', compact('aviso_privacidad', 'organizacionLogo'));
    }

    public function salida()
    {

        return view('visitantes.registro-visitantes.salida');
    }

    public function registrarSalida(RegistrarVisitante $registrarVisitante)
    {

        return view('visitantes.registro-visitantes.salida-registro', compact('registrarVisitante'));
    }
}
