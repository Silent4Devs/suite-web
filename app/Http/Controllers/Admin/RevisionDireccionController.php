<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRevisionDireccionRequest;
use App\Http\Requests\StoreRevisionDireccionRequest;
use App\Models\RevisionDireccion;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RevisionDireccionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('revision_por_direccion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RevisionDireccion::with(['team'])->select(sprintf('%s.*', (new RevisionDireccion)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'revision_por_direccion_ver';
                $editGate = 'revision_por_direccion_editar';
                $deleteGate = 'revision_por_direccion_eliminar';
                $crudRoutePart = 'revision-direccions';

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
            $table->editColumn('estadorevisionesprevias', function ($row) {
                return $row->estadorevisionesprevias ? $row->estadorevisionesprevias : '';
            });
            $table->editColumn('cambiosinternosexternos', function ($row) {
                return $row->cambiosinternosexternos ? $row->cambiosinternosexternos : '';
            });
            $table->editColumn('retroalimentaciondesempeno', function ($row) {
                return $row->retroalimentaciondesempeno ? $row->retroalimentaciondesempeno : '';
            });
            $table->editColumn('retroalimentacionpartesinteresadas', function ($row) {
                return $row->retroalimentacionpartesinteresadas ? $row->retroalimentacionpartesinteresadas : '';
            });
            $table->editColumn('resultadosriesgos', function ($row) {
                return $row->resultadosriesgos ? $row->resultadosriesgos : '';
            });
            $table->editColumn('oportunidadesmejoracontinua', function ($row) {
                return $row->oportunidadesmejoracontinua ? $row->oportunidadesmejoracontinua : '';
            });
            $table->editColumn('acuerdoscambios', function ($row) {
                return $row->acuerdoscambios ? $row->acuerdoscambios : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.revisionDireccions.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('revision_por_direccion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.revisionDireccions.create');
    }

    public function store(StoreRevisionDireccionRequest $request)
    {
        abort_if(Gate::denies('revision_por_direccion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion = RevisionDireccion::create($request->all());

        return redirect()->route('admin.revision-direccions.index');
    }

    public function edit(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_por_direccion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->load('team');

        return view('admin.revisionDireccions.edit', compact('revisionDireccion'));
    }

    public function update(Request $request, $revisionDireccion)
    {
        abort_if(Gate::denies('revision_por_direccion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion = RevisionDireccion::find($revisionDireccion);
        $revisionDireccion->update($request->all());

        return redirect()->route('admin.revision-direccions.index');
    }

    public function show(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_por_direccion_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->load('team');

        return view('admin.revisionDireccions.show', compact('revisionDireccion'));
    }

    public function destroy(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_por_direccion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->delete();

        return back();
    }

    public function massDestroy(MassDestroyRevisionDireccionRequest $request)
    {
        RevisionDireccion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
