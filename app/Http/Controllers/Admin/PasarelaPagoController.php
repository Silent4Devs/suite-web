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
}
