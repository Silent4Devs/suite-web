<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;

class CapitalHumanoController extends Controller
{
    public function index()
    {
        return view('admin.recursos-humanos.capital-humano');
    }
}
