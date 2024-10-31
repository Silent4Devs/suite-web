<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VistaGlobalPermisosGoceSueldoExport;
use App\Http\Controllers\Controller;
use App\Models\PermisosGoceSueldo;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class PermisosGoceSueldoController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('reglas_goce_sueldo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = PermisosGoceSueldo::getAll();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'reglas_goce_sueldo_acceder';
                $editGate = 'reglas_goce_sueldo_editar';
                $deleteGate = 'reglas_goce_sueldo_eliminar';
                $crudRoutePart = 'permisos-goce-sueldo';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('', function ($row) {
                return $row->tipo_permiso ? $row->tipo_permiso : '';
            });
            $table->editColumn('dias', function ($row) {
                return $row->dias ? $row->dias : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.permisosGoceSueldo.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('reglas_goce_sueldo_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = new PermisosGoceSueldo;

        return view('admin.permisosGoceSueldo.create', compact('vacacion'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('reglas_goce_sueldo_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'dias' => 'required|int',
            'tipo_permiso' => 'required|int',
        ]);
        $vacacion = PermisosGoceSueldo::create($request->all());
        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.permisos-goce-sueldo.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('reglas_goce_sueldo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = PermisosGoceSueldo::find($id);

        return view('admin.permisosGoceSueldo.show', compact('vacacion'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('reglas_goce_sueldo_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacacion = PermisosGoceSueldo::find($id);
        if (empty($vacacion)) {
            Alert::warning('warning', 'Información añadida con éxito');

            return redirect(route('admin.permisos-goce-sueldo.index'));
        }

        return view('admin.permisosGoceSueldo.edit', compact('vacacion'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('reglas_goce_sueldo_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'dias' => 'required|int',
            'tipo_permiso' => 'required|int',
        ]);

        $vacacion = PermisosGoceSueldo::find($id);

        $vacacion->update($request->all());

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect(route('admin.permisos-goce-sueldo.index'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('reglas_goce_sueldo_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = PermisosGoceSueldo::find($id);
        $vacaciones->delete();

        Alert::success('éxito', 'Información eliminada con éxito');

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function vistaGlobal(Request $request)
    {
        abort_if(Gate::denies('reglas_goce_sueldo_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        $solPer = SolicitudPermisoGoceSueldo::getAllwithEmpleados();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.permisosGoceSueldo.solicitudes', compact('logo_actual', 'empresa_actual', 'solPer'));
    }

    public function exportExcel()
    {
        abort_if(Gate::denies('reglas_goce_sueldo_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $export = new VistaGlobalPermisosGoceSueldoExport;

        return Excel::download($export, 'Control_Ausencias_Permisos_Goce_Sueldo.xlsx');
    }
}
