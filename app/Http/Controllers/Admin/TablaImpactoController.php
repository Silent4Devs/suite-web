<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TablaImpactoController extends Controller
{
    public function index()
    {
        return view('admin.TablaImpacto.index');
    }
}
