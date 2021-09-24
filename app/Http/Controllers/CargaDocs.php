<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargaDocs extends Controller
{
    public function index(Request $request)
    {
        return view('admin.CargaDocs.index');
    }


}
