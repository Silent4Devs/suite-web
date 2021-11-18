<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        //abort_if(Gate::denies('enlaces_ejecutar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        return view('frontend.enlacesEjecutars.index', compact('teams'));
    }

    public function create()
    {
       // abort_if(Gate::denies('enlaces_ejecutar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.enlacesEjecutars.create');
    }

    public function store(Request $request)
    {
        $enlacesEjecutar = EnlacesEjecutar::create($request->all());

        return redirect()->route('enlaces-ejecutars.index');
    }

    public function edit(EnlacesEjecutar $enlacesEjecutar)
    {
       // abort_if(Gate::denies('enlaces_ejecutar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enlacesEjecutar->load('team');

        return view('frontend.enlacesEjecutars.edit', compact('enlacesEjecutar'));
    }

    public function update(Request $request, EnlacesEjecutar $enlacesEjecutar)
    {
        $enlacesEjecutar->update($request->all());

        return redirect()->route('enlaces-ejecutars.index');
    }

    public function show(EnlacesEjecutar $enlacesEjecutar)
    {
       // abort_if(Gate::denies('enlaces_ejecutar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enlacesEjecutar->load('team');

        return view('frontend.enlacesEjecutars.show', compact('enlacesEjecutar'));
    }

    public function destroy(EnlacesEjecutar $enlacesEjecutar)
    {
       // abort_if(Gate::denies('enlaces_ejecutar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enlacesEjecutar->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        EnlacesEjecutar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
