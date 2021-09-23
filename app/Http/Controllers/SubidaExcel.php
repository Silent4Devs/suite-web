<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AmenazaImport;
use Maatwebsite\Excel\Facades\Excel;

class SubidaExcel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Amenaza()
    {
        Excel::import(new AmenazaImport, request()->file('archivo'));
        return redirect('CargaDocs')->with('success', 'All good!');
    }


}
