<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGlosarioRequest;
use App\Http\Requests\StoreGlosarioRequest;
use App\Http\Requests\UpdateGlosarioRequest;
use App\Models\Glosario;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GlosarioController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('glosario_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Glosario::query()->select(sprintf('%s.*', (new Glosario)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'glosario_show';
                $editGate      = 'glosario_edit';
                $deleteGate    = 'glosario_delete';
                $crudRoutePart = 'glosarios';

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
            $table->editColumn('concepto', function ($row) {
                return $row->concepto ? $row->concepto : "";
            });
            $table->editColumn('definicion', function ($row) {
                return $row->definicion ? $row->definicion : "";
            });
            $table->editColumn('explicacion', function ($row) {
                return $row->explicacion ? $row->explicacion : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.glosarios.index');
    }

    public function create()
    {
        abort_if(Gate::denies('glosario_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.glosarios.create');
    }

    public function store(StoreGlosarioRequest $request)
    {
        $glosario = Glosario::create($request->all());

        return redirect()->route('admin.glosarios.index');
    }

    public function edit(Glosario $glosario)
    {
        abort_if(Gate::denies('glosario_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.glosarios.edit', compact('glosario'));
    }

    public function update(UpdateGlosarioRequest $request, Glosario $glosario)
    {
        $glosario->update($request->all());

        return redirect()->route('admin.glosarios.index');
    }

    public function show(Glosario $glosario)
    {
        abort_if(Gate::denies('glosario_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.glosarios.show', compact('glosario'));
    }

    public function destroy(Glosario $glosario)
    {
        abort_if(Gate::denies('glosario_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $glosario->delete();

        return back();
    }

    public function massDestroy(MassDestroyGlosarioRequest $request)
    {
        Glosario::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
