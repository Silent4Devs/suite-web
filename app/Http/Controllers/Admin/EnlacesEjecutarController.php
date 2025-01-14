<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnlacesEjecutarRequest;
use App\Http\Requests\StoreEnlacesEjecutarRequest;
use App\Http\Requests\UpdateEnlacesEjecutarRequest;
use App\Models\EnlacesEjecutar;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EnlacesEjecutarController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('enlaces_ejecutar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EnlacesEjecutar::with(['team'])->select(sprintf('%s.*', (new EnlacesEjecutar)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'enlaces_ejecutar_show';
                $editGate = 'enlaces_ejecutar_edit';
                $deleteGate = 'enlaces_ejecutar_delete';
                $crudRoutePart = 'enlaces-ejecutars';

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
            $table->editColumn('ejecutar', function ($row) {
                return $row->ejecutar ? $row->ejecutar : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->editColumn('enlace', function ($row) {
                return $row->enlace ? $row->enlace : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.enlacesEjecutars.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('enlaces_ejecutar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.enlacesEjecutars.create');
    }

    public function store(StoreEnlacesEjecutarRequest $request)
    {
        $enlacesEjecutar = EnlacesEjecutar::create($request->all());

        return redirect()->route('admin.enlaces-ejecutars.index');
    }

    public function edit($id_enlacesEjecutar)
    {
        abort_if(Gate::denies('enlaces_ejecutar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enlacesEjecutar = EnlacesEjecutar::where('id', $id_enlacesEjecutar)->first();

        $enlacesEjecutar->load('team');

        return view('admin.enlacesEjecutars.edit', compact('enlacesEjecutar'));
    }

    public function update(UpdateEnlacesEjecutarRequest $request, $id_enlacesEjecutar)
    {
        $enlacesEjecutar = EnlacesEjecutar::where('id', $id_enlacesEjecutar)->first();

        $enlacesEjecutar->update($request->all());

        return redirect()->route('admin.enlaces-ejecutars.index');
    }

    public function show($id_enlacesEjecutar)
    {
        abort_if(Gate::denies('enlaces_ejecutar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $enlacesEjecutar = EnlacesEjecutar::where('id', $id_enlacesEjecutar)->first();

        $enlacesEjecutar->load('team');

        return view('admin.enlacesEjecutars.show', compact('enlacesEjecutar'));
    }

    public function destroy($id_enlacesEjecutar)
    {
        abort_if(Gate::denies('enlaces_ejecutar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $enlacesEjecutar = EnlacesEjecutar::where('id', $id_enlacesEjecutar)->first();

        $enlacesEjecutar->delete();

        return back();
    }

    public function massDestroy(MassDestroyEnlacesEjecutarRequest $request)
    {
        EnlacesEjecutar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
