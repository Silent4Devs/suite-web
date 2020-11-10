<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIndicadoresSgsiRequest;
use App\Http\Requests\StoreIndicadoresSgsiRequest;
use App\Http\Requests\UpdateIndicadoresSgsiRequest;
use App\Models\IndicadoresSgsi;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IndicadoresSgsiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('indicadores_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IndicadoresSgsi::with(['responsable', 'team'])->select(sprintf('%s.*', (new IndicadoresSgsi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'indicadores_sgsi_show';
                $editGate      = 'indicadores_sgsi_edit';
                $deleteGate    = 'indicadores_sgsi_delete';
                $crudRoutePart = 'indicadores-sgsis';

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
            $table->editColumn('control', function ($row) {
                return $row->control ? $row->control : "";
            });
            $table->editColumn('titulo', function ($row) {
                return $row->titulo ? $row->titulo : "";
            });
            $table->addColumn('responsable_name', function ($row) {
                return $row->responsable ? $row->responsable->name : '';
            });

            $table->editColumn('formula', function ($row) {
                return $row->formula ? $row->formula : "";
            });
            $table->editColumn('frecuencia', function ($row) {
                return $row->frecuencia ? IndicadoresSgsi::FRECUENCIA_SELECT[$row->frecuencia] : '';
            });
            $table->editColumn('unidadmedida', function ($row) {
                return $row->unidadmedida ? IndicadoresSgsi::UNIDADMEDIDA_SELECT[$row->unidadmedida] : '';
            });
            $table->editColumn('meta', function ($row) {
                return $row->meta ? $row->meta : "";
            });
            $table->editColumn('semaforo', function ($row) {
                return $row->semaforo ? IndicadoresSgsi::SEMAFORO_SELECT[$row->semaforo] : '';
            });
            $table->editColumn('enero', function ($row) {
                return $row->enero ? $row->enero : "";
            });
            $table->editColumn('febrero', function ($row) {
                return $row->febrero ? $row->febrero : "";
            });
            $table->editColumn('marzo', function ($row) {
                return $row->marzo ? $row->marzo : "";
            });
            $table->editColumn('abril', function ($row) {
                return $row->abril ? $row->abril : "";
            });
            $table->editColumn('mayo', function ($row) {
                return $row->mayo ? $row->mayo : "";
            });
            $table->editColumn('junio', function ($row) {
                return $row->junio ? $row->junio : "";
            });
            $table->editColumn('julio', function ($row) {
                return $row->julio ? $row->julio : "";
            });
            $table->editColumn('agosto', function ($row) {
                return $row->agosto ? $row->agosto : "";
            });
            $table->editColumn('septiembre', function ($row) {
                return $row->septiembre ? $row->septiembre : "";
            });
            $table->editColumn('octubre', function ($row) {
                return $row->octubre ? $row->octubre : "";
            });
            $table->editColumn('noviembre', function ($row) {
                return $row->noviembre ? $row->noviembre : "";
            });
            $table->editColumn('diciembre', function ($row) {
                return $row->diciembre ? $row->diciembre : "";
            });
            $table->editColumn('anio', function ($row) {
                return $row->anio ? $row->anio : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'responsable']);

            return $table->make(true);
        }

        $users = User::get();
        $teams = Team::get();

        return view('admin.indicadoresSgsis.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('indicadores_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.indicadoresSgsis.create', compact('responsables'));
    }

    public function store(StoreIndicadoresSgsiRequest $request)
    {
        $indicadoresSgsi = IndicadoresSgsi::create($request->all());

        return redirect()->route('admin.indicadores-sgsis.index');
    }

    public function edit(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $indicadoresSgsi->load('responsable', 'team');

        return view('admin.indicadoresSgsis.edit', compact('responsables', 'indicadoresSgsi'));
    }

    public function update(UpdateIndicadoresSgsiRequest $request, IndicadoresSgsi $indicadoresSgsi)
    {
        $indicadoresSgsi->update($request->all());

        return redirect()->route('admin.indicadores-sgsis.index');
    }

    public function show(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $indicadoresSgsi->load('responsable', 'team');

        return view('admin.indicadoresSgsis.show', compact('indicadoresSgsi'));
    }

    public function destroy(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $indicadoresSgsi->delete();

        return back();
    }

    public function massDestroy(MassDestroyIndicadoresSgsiRequest $request)
    {
        IndicadoresSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
