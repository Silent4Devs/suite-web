<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitantes\RegistrarVisitante;
use Illuminate\Http\Request;

class VisitantesController extends Controller
{
    public function menu()
    {
        return view('admin.visitantes.menu');
    }

    public function index()
    {
        return view('admin.visitantes.index');
    }

    public function dashboard()
    {
        return view('admin.visitantes.dashboard');
    }

    public function autorizar()
    {
        return view('admin.visitantes.autorizar');
    }

    public function configuracion()
    {
        return view('admin.visitantes.configuracion');
    }
}
