<?php

namespace App\Http\Controllers;

class NotificacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('notificaciones.index');
    }
}
