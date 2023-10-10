<?php

namespace App\Http\Controllers;

use App\Models\User;

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
