<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyControleRequest;
use App\Http\Requests\StoreControleRequest;
use App\Http\Requests\UpdateControleRequest;
use App\Models\Controle;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ControlesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('controle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Controle::with(['team'])->select(sprintf('%s.*', (new Controle)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'controle_show';
                $editGate = 'controle_edit';
                $deleteGate = 'controle_delete';
                $crudRoutePart = 'controles';

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
            $table->editColumn('numero', function ($row) {
                return $row->numero ? $row->numero : '';
            });
            $table->editColumn('control', function ($row) {
                return $row->control ? $row->control : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.controles.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('controle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.controles.create');
    }

    public function store(StoreControleRequest $request)
    {
        $controle = Controle::create($request->all());

        return redirect()->route('admin.controles.index');
    }

    public function edit(Controle $controle)
    {
        abort_if(Gate::denies('controle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controle->load('team');

        return view('admin.controles.edit', compact('controle'));
    }

    public function update(UpdateControleRequest $request, Controle $controle)
    {
        $controle->update($request->all());

        return redirect()->route('admin.controles.index');
    }

    public function show(Controle $controle)
    {
        abort_if(Gate::denies('controle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controle->load('team');

        return view('admin.controles.show', compact('controle'));
    }

    public function destroy(Controle $controle)
    {
        abort_if(Gate::denies('controle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controle->delete();

        return back();
    }

    public function massDestroy(MassDestroyControleRequest $request)
    {
        Controle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
