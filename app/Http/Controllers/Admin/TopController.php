<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function index()
    {
        return view('admin.analisisdebrecha2022nv.top.index');
    }
}
