<?php

namespace App\Http\Controllers\frontend;

use App\Exports\EmpleadosExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class OrganigramaController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('organigrama_organizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // La construccion del arbol necesita un primer nodo (NULL)
        $organizacionTree = Empleado::with(['supervisor.children', 'supervisor.supervisor', 'area', 'children.supervisor', 'children.children'])->whereNull('supervisor_id')->first(); //Eager loading
        if ($request->ajax()) {
            if ($request->area_filter == 'true') {
                $treeByArea = Empleado::with(['area', 'children' => function ($q) use ($request) {
                    $q->where('area_id', $request->area_id);
                }, 'children.children' => function ($q) use ($request) {
                    $q->where('area_id', $request->area_id);
                }])->where('area_id', $request->area_id)->first();

                return $treeByArea->toJson();
            } else {
                if ($request->id == null) {
                    // La construccion del arbol necesita un primer nodo (NULL)
                    $organizacionTree = Empleado::with(['supervisor.children', 'supervisor.supervisor', 'area', 'children.supervisor', 'children.children'])->whereNull('supervisor_id')->first(); //Eager loading

                    return $organizacionTree->toJson();
                } else {
                    $organizacionTree = Empleado::with(['supervisor.children', 'supervisor.supervisor', 'area', 'children.supervisor', 'children.children'])->where('id', '=', $request->id)->first(); //Eager loading
                    if ($organizacionTree != null) {
                        return $organizacionTree->toJson();
                    } else {
                        return 'No encontrado';
                    }
                }
            }
        }
        $rutaImagenes = asset('storage/empleados/imagenes/');
        $organizacionDB = Organizacion::getFirst();
        $organizacion = !is_null($organizacionDB) ? Organizacion::select('empresa')->first()->empresa : 'la organización';
        $org_foto = !is_null($organizacionDB) ? url('images/' . DB::table('organizacions')->select('logotipo')->first()->logotipo) : url('img/Silent4Business-Logo-Color.png');
        $areas = Area::getAll();

        return view('frontend.organigrama.index', compact('organizacionTree', 'rutaImagenes', 'organizacion', 'org_foto', 'areas'));
    }

    public function exportTo()
    {
        abort_if(Gate::denies('organigrama_organizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return Excel::download(new EmpleadosExport, 'empleados.xlsx');
    }
}
