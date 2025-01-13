<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRiesgosoportunidadeRequest;
use App\Http\Requests\StoreRiesgosoportunidadeRequest;
use App\Http\Requests\UpdateRiesgosoportunidadeRequest;
use App\Models\Controle;
use App\Models\Riesgosoportunidade;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RiesgosoportunidadesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('riesgosoportunidade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Riesgosoportunidade::with(['control', 'team'])->select(sprintf('%s.*', (new Riesgosoportunidade)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'riesgosoportunidade_show';
                $editGate = 'riesgosoportunidade_edit';
                $deleteGate = 'riesgosoportunidade_delete';
                $crudRoutePart = 'riesgosoportunidades';

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
            $table->addColumn('control_control', function ($row) {
                return $row->control ? $row->control->control : '';
            });

            $table->editColumn('aplicaorganizacion', function ($row) {
                return $row->aplicaorganizacion ? Riesgosoportunidade::APLICAORGANIZACION_SELECT[$row->aplicaorganizacion] : '';
            });
            $table->editColumn('justificacion', function ($row) {
                return $row->justificacion ? $row->justificacion : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'control']);

            return $table->make(true);
        }

        $controles = Controle::get();
        $teams = Team::get();

        return view('admin.riesgosoportunidades.index', compact('controles', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('riesgosoportunidade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.riesgosoportunidades.create', compact('controls'));
    }

    public function store(StoreRiesgosoportunidadeRequest $request)
    {
        $riesgosoportunidade = Riesgosoportunidade::create($request->all());

        return redirect()->route('admin.riesgosoportunidades.index')->with('success', 'Guardado con éxito');
    }

    public function edit($id_riesgosoportunidade)
    {
        abort_if(Gate::denies('riesgosoportunidade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgosoportunidade = Riesgosoportunidade::where('id', $id_riesgosoportunidade)->first();

        $controls = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $riesgosoportunidade->load('control', 'team');

        return view('admin.riesgosoportunidades.edit', compact('controls', 'riesgosoportunidade'));
    }

    public function update(UpdateRiesgosoportunidadeRequest $request, $id_riesgosoportunidade)
    {
        $riesgosoportunidade = Riesgosoportunidade::where('id', $id_riesgosoportunidade)->first();

        $riesgosoportunidade->update($request->all());

        return redirect()->route('admin.riesgosoportunidades.index')->with('success', 'Editado con éxito');
    }

    public function show($id_riesgosoportunidade)
    {
        abort_if(Gate::denies('riesgosoportunidade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $riesgosoportunidade = Riesgosoportunidade::where('id', $id_riesgosoportunidade)->first();

        $riesgosoportunidade->load('control', 'team');

        return view('admin.riesgosoportunidades.show', compact('riesgosoportunidade'));
    }

    public function destroy($id_riesgosoportunidade)
    {
        abort_if(Gate::denies('riesgosoportunidade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $riesgosoportunidade = Riesgosoportunidade::where('id', $id_riesgosoportunidade)->first();
        $riesgosoportunidade->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyRiesgosoportunidadeRequest $request)
    {
        Riesgosoportunidade::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
