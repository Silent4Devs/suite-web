<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPoliticaSgsiRequest;
use App\Http\Requests\StorePoliticaSgsiRequest;
use App\Http\Requests\UpdatePoliticaSgsiRequest;
use App\Models\Empleado;
use App\Models\organizacion;
use App\Models\PoliticaSgsi;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PoliticaSgsiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('politica_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PoliticaSgsi::with(['team', 'reviso'])->select(sprintf('%s.*', (new PoliticaSgsi)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'politica_sgsi_show';
                $editGate = 'politica_sgsi_edit';
                $deleteGate = 'politica_sgsi_delete';
                $crudRoutePart = 'politica-sgsis';

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
            $table->editColumn('politicasgsi', function ($row) {
                return $row->politicasgsi ? strip_tags($row->politicasgsi) : '';
            });
            $table->editColumn('fecha_publicacion', function ($row) {
                return $row->fecha_publicacion ? $row->fecha_publicacion : '';
            });
            $table->editColumn('fecha_entrada', function ($row) {
                return $row->fecha_entrada ? $row->fecha_entrada : '';
            });
            $table->addColumn('reviso_politica', function ($row) {
                return $row->reviso ? $row->reviso : '';
            });
            $table->editColumn('puesto_reviso', function ($row) {
                return $row->reviso ? $row->reviso->puesto : '';
            });
            $table->editColumn('area_reviso', function ($row) {
                return $row->reviso ? $row->reviso->area->area : '';
            });
            $table->editColumn('fecha_revision', function ($row) {
                return $row->fecha_revision ? $row->fecha_revision : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $politicaSgsis = PoliticaSgsi::all();

        $teams = Team::get();

        $empleados = Empleado::with('area')->get();

        return view('frontend.politicaSgsis.index', compact('politicaSgsis', 'teams', 'empleados'));
    }

    public function create()
    {
        abort_if(Gate::denies('politica_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::with('area')->get();

        return view('frontend.politicaSgsis.create', compact('empleados'));
    }

    public function store(StorePoliticaSgsiRequest $request)
    {
        // dd($request->all());
        $politicaSgsi = PoliticaSgsi::create($request->all());

        return redirect()->route('politica-sgsis.index')->with('success', 'Guardado con éxito');
    }

    public function edit(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        $empleados = Empleado::with('area')->get();

        return view('frontend.politicaSgsis.edit', compact('politicaSgsi', 'empleados'));
    }

    public function update(UpdatePoliticaSgsiRequest $request, PoliticaSgsi $politicaSgsi)
    {
        $politicaSgsi->update($request->all());

        return redirect()->route('politica-sgsis.index')->with('success', 'Editado con éxito');
    }

    public function show(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        return view('frontend.politicaSgsis.show', compact('politicaSgsi'));
    }

    public function destroy(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyPoliticaSgsiRequest $request)
    {
        PoliticaSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function visualizacion()
    {
        $politicaSgsis = PoliticaSgsi::first();

        $organizacions = Organizacion::getFirst();

        return view('frontend.politicaSgsis.visualizacion', compact('politicaSgsis'));
    }
}
