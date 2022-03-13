<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TablaImpactoController extends Controller
{
    public function index(){


        return view('admin.TablaImpacto.index');


    }



}
