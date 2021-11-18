<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\Puesto;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PuestosController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        //abort_if(Gate::denies('puesto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Puesto::with(['team'])->select(sprintf('%s.*', (new Puesto)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'puesto_show';
                $editGate = 'puesto_edit';
                $deleteGate = 'puesto_delete';
                $crudRoutePart = 'puestos';

                return view('partials.datatablesActionsFrontend', compact(
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('frontend.puestos.index', compact('teams'));
    }

    public function create()
    {
       // abort_if(Gate::denies('puesto_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.puestos.create');
    }

    public function store(Request $request)
    {
        $puesto = Puesto::create($request->all());

        return redirect()->route('puestos.index');
    }

    public function edit(Puesto $puesto)
    {
       // abort_if(Gate::denies('puesto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->load('team');

        return view('frontend.puestos.edit', compact('puesto'));
    }

    public function update(Request $request, Puesto $puesto)
    {
        $puesto->update($request->all());

        return redirect()->route('puestos.index');
    }

    public function show(Puesto $puesto)
    {
       // abort_if(Gate::denies('puesto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->load('team');

        return view('frontend.puestos.show', compact('puesto'));
    }

    public function destroy(Puesto $puesto)
    {
       // abort_if(Gate::denies('puesto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Puesto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
