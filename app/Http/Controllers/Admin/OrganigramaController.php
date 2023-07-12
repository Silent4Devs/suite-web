<?php

namespace App\Http\Controllers\Admin;

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
        abort_if(Gate::denies('organigrama_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // La construccion del arbol necesita un primer nodo (NULL)
        $organizacionTree = Empleado::exists();
        if ($request->ajax()) {
            if ($request->area_filter == 'true') {
                $treeByArea = Area::with(['lider' => function ($query) {
                    $query->select('id', 'name', 'area_id', 'foto', 'puesto_id', 'antiguedad', 'email', 'telefono', 'estatus', 'n_registro', 'n_empleado', 'genero', 'telefono_movil')->with('children');
                }])->find($request->area_id)->lider;

                return $treeByArea->toJson();
            } else {
                if ($request->id == null) {
                    // La construccion del arbol necesita un primer nodo (NULL)
                    $organizacionTree = Empleado::select('id', 'name', 'area_id', 'foto', 'puesto_id', 'antiguedad', 'email', 'telefono', 'estatus', 'n_registro', 'n_empleado', 'genero', 'telefono_movil')->vacanteActiva()->with(['supervisor.childrenOrganigrama', 'supervisor.supervisor' => function ($queryC) {
                        return $queryC->select('id', 'name', 'foto', 'puesto_id', 'genero');
                    }, 'area' => function ($queryC) {
                        return $queryC->select('id', 'area');
                    }, 'childrenOrganigrama.supervisor' => function ($queryC) {
                        return $queryC->select('id', 'name', 'foto', 'puesto_id', 'genero');
                    }, 'childrenOrganigrama.childrenOrganigrama'])->whereNull('supervisor_id')->first(); //Eager loading

                    return $organizacionTree->toJson();
                } else {
                    $organizacionTree = Empleado::select('id', 'name', 'area_id', 'foto', 'puesto_id', 'antiguedad', 'email', 'telefono', 'estatus', 'n_registro', 'n_empleado', 'genero', 'telefono_movil')->vacanteActiva()->with(['supervisor.childrenOrganigrama', 'supervisor.supervisor' => function ($queryC) {
                        return $queryC->select('id', 'name', 'foto', 'puesto_id', 'genero');
                    }, 'area' => function ($queryC) {
                        return $queryC->select('id', 'area');
                    }, 'childrenOrganigrama.supervisor' => function ($queryC) {
                        return $queryC->select('id', 'name', 'foto', 'puesto_id', 'genero');
                    }, 'childrenOrganigrama.childrenOrganigrama'])->where('id', '=', $request->id)->first(); //Eager loading
                    if ($organizacionTree != null) {
                        return $organizacionTree->toJson();
                    } else {
                        return 'No encontrado';
                    }
                }
            }
        }
        $rutaImagenes = asset('storage/empleados/imagenes/');
        $organizacionDB = Organizacion::first();
        $organizacion = !is_null($organizacionDB) ? Organizacion::select('empresa')->first()->empresa : 'la organización';
        $org_foto = !is_null($organizacionDB) ? url('images/' . DB::table('organizacions')->select('logotipo')->first()->logotipo) : url('img/Silent4Business-Logo-Color.png');
        $areas = Area::getAll();

        return view('admin.organigrama.index', compact('organizacionTree', 'rutaImagenes', 'organizacion', 'org_foto', 'areas'));
    }

    public function exportTo()
    {
        abort_if(Gate::denies('organigrama_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return Excel::download(new EmpleadosExport, 'empleados.xlsx');
    }
}
