<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    //
    public function TypeCatalogueTraining()
    {
        return view('admin.typeCatalogueTraining.tbIndex');
    }
}
