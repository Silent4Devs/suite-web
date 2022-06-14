<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarpetumRequest;
use App\Http\Requests\StoreCarpetumRequest;
use App\Http\Requests\UpdateCarpetumRequest;
use App\Models\Carpetum;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CarpetasController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(
        //     Gate::denies('carpetum_access')
        //         && Gate::denies('documentos_publicados_respositorio_access')
        //         && Gate::denies('documentos_aprobacion_respositorio_access')
        //         && Gate::denies('documentos_obsoletos_respositorio_access')
        //         && Gate::denies('documentos_versiones_anteriores_respositorio_access'),
        //     Response::HTTP_FORBIDDEN,
        //     '403 Forbidden'
        // );
        abort_if(Gate::denies('repositorio_documental_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Carpetum::with(['team'])->select(sprintf('%s.*', (new Carpetum)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'carpetum_show';
                $editGate = 'carpetum_edit';
                $deleteGate = 'carpetum_delete';
                $crudRoutePart = 'carpeta';

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
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.carpeta.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('carpetum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.carpeta.create');
    }

    public function store(StoreCarpetumRequest $request)
    {
        $carpetum = Carpetum::create($request->all());

        return redirect()->route('admin.carpeta.index');
    }

    public function edit(Carpetum $carpetum)
    {
        abort_if(Gate::denies('carpetum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpetum->load('team');

        return view('admin.carpeta.edit', compact('carpetum'));
    }

    public function update(UpdateCarpetumRequest $request, Carpetum $carpetum)
    {
        $carpetum->update($request->all());

        return redirect()->route('admin.carpeta.index');
    }

    public function show(Carpetum $carpetum)
    {
        abort_if(Gate::denies('carpetum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpetum->load('team');

        return view('admin.carpeta.show', compact('carpetum'));
    }

    public function destroy(Carpetum $carpetum)
    {
        abort_if(Gate::denies('carpetum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpetum->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarpetumRequest $request)
    {
        Carpetum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
