<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGapUnoRequest;
use App\Http\Requests\StoreGapUnoRequest;
use App\Models\GapUno;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GapUnoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('gap_uno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GapUno::with(['team'])->select(sprintf('%s.*', (new GapUno)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'gap_uno_show';
                $editGate = 'gap_uno_edit';
                $deleteGate = 'gap_uno_delete';
                $crudRoutePart = 'gap-unos';

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
            $table->editColumn('pregunta', function ($row) {
                return $row->pregunta ? $row->pregunta : '';
            });
            $table->editColumn('valoracion', function ($row) {
                return $row->valoracion ? GapUno::VALORACION_SELECT[$row->valoracion] : '';
            });
            $table->editColumn('evidencia', function ($row) {
                return $row->evidencia ? $row->evidencia : '';
            });
            $table->editColumn('recomendacion', function ($row) {
                return $row->recomendacion ? $row->recomendacion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.gapUnos.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('gap_uno_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gapUnos.create');
    }

    public function store(StoreGapUnoRequest $request)
    {
        $gapUno = GapUno::create($request->all());

        return redirect()->route('admin.gap-unos.index');
    }

    public function edit(GapUno $gapUno)
    {
        abort_if(Gate::denies('gap_uno_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapUno->load('team');

        return view('admin.gapUnos.edit', compact('gapUno'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            switch ($request->name) {
                case 'evidencia':
                    $gapun = GapUno::findOrFail($id);
                    $gapun->evidencia = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'recomendacion':
                    $gapun = GapUno::findOrFail($id);
                    $gapun->recomendacion = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'valoracion':
                    $gapun = GapUno::findOrFail($id);
                    $gapun->valoracion = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
            }
        }

        /*$planaccionCorrectiva->update($request->all());
        return redirect()->route('admin.planaccion-correctivas.index');*/
    }

    public function show(GapUno $gapUno)
    {
        abort_if(Gate::denies('gap_uno_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapUno->load('team');

        return view('admin.gapUnos.show', compact('gapUno'));
    }

    public function destroy(GapUno $gapUno)
    {
        abort_if(Gate::denies('gap_uno_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapUno->delete();

        return back();
    }

    public function massDestroy(MassDestroyGapUnoRequest $request)
    {
        GapUno::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
