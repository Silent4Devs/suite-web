<?php

namespace App\Http\Controllers;

class TareasNotificacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tareas.index');
    }
}
