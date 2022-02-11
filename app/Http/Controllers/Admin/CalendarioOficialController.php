<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarioOficial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class CalendarioOficialController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('dias_festivos_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = CalendarioOficial::orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'dias_festivos_show';
                $editGate = 'dias_festivos_edit';
                $deleteGate = 'dias_festivos_delete';
                $crudRoutePart = 'calendario-oficial';

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
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? $row->fecha : '';
            });
            $table->editColumn('categoria', function ($row) {
                return $row->categoria ? $row->categoria : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.calendario-oficial.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('dias_festivos_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $calendario = new CalendarioOficial();

        return view('admin.calendario-oficial.create', compact('calendario'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('dias_festivos_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $fecha = CalendarioOficial::create($request->all());

        return redirect(route('admin.calendario-oficial.index'))->with(['success' => 'Registro guardado con exito']);
    }

    public function show(CalendarioOficial $calendario)
    {
        // abort_if(Gate::denies('enlaces_ejecutar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('dias_festivos_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.calendario-oficial.show', compact('calendario-oficial'));
    }

    public function edit($calendario)
    {
        abort_if(Gate::denies('dias_festivos_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $calendario = CalendarioOficial::find($calendario);

        return view('admin.calendario-oficial.edit', compact('calendario'));
    }

    public function update(Request $request, $calendario)
    {
        abort_if(Gate::denies('dias_festivos_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $calendario = CalendarioOficial::find($calendario);
        $fecha = $calendario->update($request->all());

        return redirect(route('admin.calendario-oficial.index'))->with(['success' => 'Registro Actualizado']);
    }

    public function destroy($calendario)
    {
        abort_if(Gate::denies('dias_festivos_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $calendario = CalendarioOficial::find($calendario);
        $calendario->delete();

        return redirect(route('admin.calendario-oficial.index'))->with(['success' => 'Registro Eliminado']);
    }
}
