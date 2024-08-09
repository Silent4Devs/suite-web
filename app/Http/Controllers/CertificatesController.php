<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    //
    public function CatalogueTraining()
    {
        return view('admin.catalogueTraining.tbIndex');
    }
}
