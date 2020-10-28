<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatrizRequisitoLegaleRequest;
use App\Http\Requests\StoreMatrizRequisitoLegaleRequest;
use App\Http\Requests\UpdateMatrizRequisitoLegaleRequest;
use App\Models\MatrizRequisitoLegale;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MatrizRequisitoLegalesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('matriz_requisito_legale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MatrizRequisitoLegale::with(['team'])->select(sprintf('%s.*', (new MatrizRequisitoLegale)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'matriz_requisito_legale_show';
                $editGate      = 'matriz_requisito_legale_edit';
                $deleteGate    = 'matriz_requisito_legale_delete';
                $crudRoutePart = 'matriz-requisito-legales';

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
            $table->editColumn('nombrerequisito', function ($row) {
                return $row->nombrerequisito ? $row->nombrerequisito : "";
            });

            $table->editColumn('requisitoacumplir', function ($row) {
                return $row->requisitoacumplir ? $row->requisitoacumplir : "";
            });
            $table->editColumn('cumplerequisito', function ($row) {
                return $row->cumplerequisito ? MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT[$row->cumplerequisito] : '';
            });
            $table->editColumn('formacumple', function ($row) {
                return $row->formacumple ? $row->formacumple : "";
            });
            $table->editColumn('periodicidad_cumplimiento', function ($row) {
                return $row->periodicidad_cumplimiento ? $row->periodicidad_cumplimiento : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.matrizRequisitoLegales.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_requisito_legale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.matrizRequisitoLegales.create');
    }

    public function store(StoreMatrizRequisitoLegaleRequest $request)
    {
        $matrizRequisitoLegale = MatrizRequisitoLegale::create($request->all());

        return redirect()->route('admin.matriz-requisito-legales.index');
    }

    public function edit(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->load('team');

        return view('admin.matrizRequisitoLegales.edit', compact('matrizRequisitoLegale'));
    }

    public function update(UpdateMatrizRequisitoLegaleRequest $request, MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        $matrizRequisitoLegale->update($request->all());

        return redirect()->route('admin.matriz-requisito-legales.index');
    }

    public function show(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->load('team');

        return view('admin.matrizRequisitoLegales.show', compact('matrizRequisitoLegale'));
    }

    public function destroy(MatrizRequisitoLegale $matrizRequisitoLegale)
    {
        abort_if(Gate::denies('matriz_requisito_legale_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matrizRequisitoLegale->delete();

        return back();
    }

    public function massDestroy(MassDestroyMatrizRequisitoLegaleRequest $request)
    {
        MatrizRequisitoLegale::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
