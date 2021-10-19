<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRevisionDireccionRequest;
use App\Http\Requests\StoreRevisionDireccionRequest;
use App\Http\Requests\UpdateRevisionDireccionRequest;
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
        abort_if(Gate::denies('revision_direccion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RevisionDireccion::with(['team'])->select(sprintf('%s.*', (new RevisionDireccion)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'revision_direccion_show';
                $editGate = 'revision_direccion_edit';
                $deleteGate = 'revision_direccion_delete';
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
        abort_if(Gate::denies('revision_direccion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.revisionDireccions.create');
    }

    public function store(StoreRevisionDireccionRequest $request)
    {
        $revisionDireccion = RevisionDireccion::create($request->all());

        return redirect()->route('admin.revision-direccions.index');
    }

    public function edit(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_direccion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->load('team');

        return view('admin.revisionDireccions.edit', compact('revisionDireccion'));
    }

    public function update(UpdateRevisionDireccionRequest $request, RevisionDireccion $revisionDireccion)
    {
        $revisionDireccion->update($request->all());

        return redirect()->route('admin.revision-direccions.index');
    }

    public function show(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_direccion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->load('team');

        return view('admin.revisionDireccions.show', compact('revisionDireccion'));
    }

    public function destroy(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_direccion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->delete();

        return back();
    }

    public function massDestroy(MassDestroyRevisionDireccionRequest $request)
    {
        RevisionDireccion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
