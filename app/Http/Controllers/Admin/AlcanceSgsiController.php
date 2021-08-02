<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAlcanceSgsiRequest;
use App\Http\Requests\StoreAlcanceSgsiRequest;
use App\Http\Requests\UpdateAlcanceSgsiRequest;
use App\Models\AlcanceSgsi;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AlcanceSgsiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('alcance_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AlcanceSgsi::with(['team'])->select(sprintf('%s.*', (new AlcanceSgsi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'alcance_sgsi_show';
                $editGate      = 'alcance_sgsi_edit';
                $deleteGate    = 'alcance_sgsi_delete';
                $crudRoutePart = 'alcance-sgsis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('alcancesgsi', function ($row) {
                return $row->alcancesgsi ? $row->alcancesgsi : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.alcanceSgsis.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('alcance_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.alcanceSgsis.create');
    }

    public function store(StoreAlcanceSgsiRequest $request)
    {
        $alcanceSgsi = AlcanceSgsi::create($request->all());

        return redirect()->route('admin.alcance-sgsis.index')->with("success", 'Guardado con éxito');
    }

    public function edit(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('alcance_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('team');

        return view('admin.alcanceSgsis.edit', compact('alcanceSgsi'));
    }

    public function update(UpdateAlcanceSgsiRequest $request, AlcanceSgsi $alcanceSgsi)
    {
        $alcanceSgsi->update($request->all());

        return redirect()->route('admin.alcance-sgsis.index')->with("success", 'Editado con éxito');
    }

    public function show(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('alcance_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('team');

        return view('admin.alcanceSgsis.show', compact('alcanceSgsi'));
    }

    public function destroy(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('alcance_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->delete();

        return back()->with('deleted','Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyAlcanceSgsiRequest $request)
    {
        AlcanceSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
