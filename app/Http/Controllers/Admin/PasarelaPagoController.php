<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasarelaPagoController extends Controller
{
    public function index(Request $request)
    {

        return view('admin.pasarelaPago.inicio-servicios');
    }

    public function planesPrecios(Request $request)
    {

        return view('admin.pasarelaPago.planes-precios');
    }

    public function prePago(Request $request)
    {

        return view('admin.pasarelaPago.pre-pago');
    }

    public function pago(Request $request)
    {

        return view('admin.pasarelaPago.pago');
    }
}
