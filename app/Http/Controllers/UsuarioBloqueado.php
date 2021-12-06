<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioBloqueado extends Controller
{
    public function __construct()
    {
        $this->middleware('isActive');
    }
    public function usuarioBloqueado(User $user)
    {
        return view('usuario-bloqueado.index', compact('user'));
    }
}
