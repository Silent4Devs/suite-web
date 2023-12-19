<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AnalisDeBrecha2022NVController extends Controller
{
    public function index()
    {
        return view('admin.analisisdebrecha2022nv.analisisdebrecha.index');
    }
}
