<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDmaicRequest;
use App\Http\Requests\StoreDmaicRequest;
use App\Http\Requests\UpdateDmaicRequest;
use App\Models\Dmaic;
use App\Models\Registromejora;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DmaicController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('dmaic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Dmaic::with(['mejora', 'team'])->select(sprintf('%s.*', (new Dmaic)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'dmaic_show';
                $editGate = 'dmaic_edit';
                $deleteGate = 'dmaic_delete';
                $crudRoutePart = 'dmaics';

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
            $table->addColumn('mejora_nombre', function ($row) {
                return $row->mejora ? $row->mejora->nombre : '';
            });

            $table->editColumn('definir', function ($row) {
                return $row->definir ? $row->definir : '';
            });
            $table->editColumn('medir', function ($row) {
                return $row->medir ? $row->medir : '';
            });
            $table->editColumn('analizar', function ($row) {
                return $row->analizar ? $row->analizar : '';
            });
            $table->editColumn('implementar', function ($row) {
                return $row->implementar ? $row->implementar : '';
            });
            $table->editColumn('controlar', function ($row) {
                return $row->controlar ? $row->controlar : '';
            });
            $table->editColumn('leccionesaprendidas', function ($row) {
                return $row->leccionesaprendidas ? $row->leccionesaprendidas : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'mejora']);

            return $table->make(true);
        }

        $registromejoras = Registromejora::get();
        $teams = Team::get();

        return view('admin.dmaics.index', compact('registromejoras', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('dmaic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Registromejora::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dmaics.create', compact('mejoras'));
    }

    public function store(StoreDmaicRequest $request)
    {
        $dmaic = Dmaic::create($request->all());

        return redirect()->route('admin.dmaics.index');
    }

    public function edit(Dmaic $dmaic)
    {
        abort_if(Gate::denies('dmaic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Registromejora::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dmaic->load('mejora', 'team');

        return view('admin.dmaics.edit', compact('mejoras', 'dmaic'));
    }

    public function update(UpdateDmaicRequest $request, Dmaic $dmaic)
    {
        $dmaic->update($request->all());

        return redirect()->route('admin.dmaics.index');
    }

    public function show(Dmaic $dmaic)
    {
        abort_if(Gate::denies('dmaic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dmaic->load('mejora', 'team');

        return view('admin.dmaics.show', compact('dmaic'));
    }

    public function destroy(Dmaic $dmaic)
    {
        abort_if(Gate::denies('dmaic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dmaic->delete();

        return back();
    }

    public function massDestroy(MassDestroyDmaicRequest $request)
    {
        Dmaic::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
