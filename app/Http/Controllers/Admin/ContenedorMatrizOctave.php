<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContenedorMatrizOctave extends Controller
{
    public function index()
    {
        return view('admin.ContenedorMatrizOctave.index');
    }
}
