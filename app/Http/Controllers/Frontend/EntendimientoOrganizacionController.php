<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEntendimientoOrganizacionRequest;
use App\Models\Empleado;
use App\Models\EntendimientoOrganizacion;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntendimientoOrganizacionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('entendimiento_organizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //$obtener_FODA = EntendimientoOrganizacion::first();
        // $query = EntendimientoOrganizacion::with('empleado')->get();
        // dd($query);
        if ($request->ajax()) {
            $query = EntendimientoOrganizacion::with('empleado')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'entendimiento_organizacion_show';
                $editGate = 'entendimiento_organizacion_edit';
                $deleteGate = 'entendimiento_organizacion_delete';
                $crudRoutePart = 'entendimiento-organizacions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('fortaleza', function ($row) {
                return $row->fortaleza ? strip_tags($row->fortaleza) : '';
            });
            $table->editColumn('oportunidades', function ($row) {
                return $row->oportunidades ? $row->oportunidades : '';
            });
            $table->editColumn('debilidades', function ($row) {
                return $row->debilidades ? $row->debilidades : '';
            });
            $table->editColumn('amenazas', function ($row) {
                return $row->amenazas ? $row->amenazas : '';
            });
            $table->editColumn('analisis', function ($row) {
                return $row->analisis ? $row->analisis : '';
            });
            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? $row->fecha : '';
            });
            $table->editColumn('elabora', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $obtener_FODA = EntendimientoOrganizacion::first();
        $empleado = Empleado::getAll();
        $teams = Team::get();

        return view('admin.entendimientoOrganizacions.index', compact('obtener_FODA', 'teams', 'empleado'));
    }

    public function create()
    {
        abort_if(Gate::denies('entendimiento_organizacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entendimientoOrganizacion = new EntendimientoOrganizacion;
        $empleados = Empleado::getAll();

        return view('admin.entendimientoOrganizacions.create', compact('entendimientoOrganizacion', 'empleados'));
    }

    public function store(Request $request, EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        $request->validate([
            'fortalezas' => 'required|string',
            'debilidades' => 'required|string',
            'oportunidades' => 'required|string',
            'amenazas' => 'required|string',
            'analisis' => 'required|string',
            'fecha' => 'required|string',
            'id_elabora' => 'required|string',

        ]);
        $entendimientoOrganizacion->create($request->all());

        return redirect()->route('admin.entendimiento-organizacions.index')->with('success', 'Análisis FODA creado correctamente');
    }

    public function edit(EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('entendimiento_organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getAll();

        return view('admin.entendimientoOrganizacions.edit', compact('entendimientoOrganizacion', 'empleados'));
    }

    public function update(Request $request, EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        $request->validate([
            'fortalezas' => 'required|string',
            'debilidades' => 'required|string',
            'oportunidades' => 'required|string',
            'amenazas' => 'required|string',
            'analisis' => 'required|string',
            'fecha' => 'required|string',
            'id_elabora' => 'required|string',

        ]);

        $entendimientoOrganizacion->update($request->all());

        return redirect()->route('admin.entendimiento-organizacions.index')->with('success', 'Análisis FODA actualizado correctamente');
    }

    public function show(EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('entendimiento_organizacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getAll();
        $obtener_FODA = $entendimientoOrganizacion;

        return view('admin.entendimientoOrganizacions.show', compact('empleados', 'obtener_FODA'));
    }

    public function destroy(EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('entendimiento_organizacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entendimientoOrganizacion->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyEntendimientoOrganizacionRequest $request)
    {
        EntendimientoOrganizacion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    // public function edit()
    // {
    //     abort_if(Gate::denies('entendimiento_organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return view('admin.entendimiento-organizacion.edit');
    // }

    // public function massDestroy(MassDestroyAreaRequest $request)
    // {
    //     Area::whereIn('id', request('ids'))->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }
}
