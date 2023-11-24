<?php

namespace App\Http\Controllers\Admin;

// use App\Functions\GenerateAnalisisB;
// use App\Functions\Porcentaje;
use App\Http\Controllers\Controller;
// use App\Http\Requests\MassDestroyAnalisisBrechasRequest;
// use App\Models\AnalisisBrecha;
// use App\Models\Empleado;
// use App\Models\GapDo;
// use App\Models\GapTre;
// use App\Models\GapUno;
// use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;

// use Yajra\DataTables\Facades\DataTables;

class TemplateController extends Controller
{
    public function index()
    {

        return view('admin.analisisdebrecha2022nv.templatess.index');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
