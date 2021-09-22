<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Evaluacion360Controller extends Controller
{
    public function index()
    {
        return view('admin.recursos-humanos.index');
    }
}
