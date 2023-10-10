<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGapDoRequest;
use App\Http\Requests\StoreGapDoRequest;
use App\Models\GapDo;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GapDosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('gap_do_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GapDo::with(['team'])->select(sprintf('%s.*', (new GapDo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'gap_do_show';
                $editGate = 'gap_do_edit';
                $deleteGate = 'gap_do_delete';
                $crudRoutePart = 'gap-dos';

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
            $table->editColumn('anexo_indice', function ($row) {
                return $row->anexo_indice ? $row->anexo_indice : '';
            });
            $table->editColumn('control', function ($row) {
                return $row->control ? $row->control : '';
            });
            $table->editColumn('descripcion_control', function ($row) {
                return $row->descripcion_control ? $row->descripcion_control : '';
            });
            $table->editColumn('valoracion', function ($row) {
                return $row->valoracion ? GapDo::VALORACION_SELECT[$row->valoracion] : '';
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

        return view('admin.gapDos.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('gap_do_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gapDos.create');
    }

    public function store(StoreGapDoRequest $request)
    {
        $gapDo = GapDo::create($request->all());

        return redirect()->route('admin.gap-dos.index');
    }

    public function edit(GapDo $gapDo)
    {
        abort_if(Gate::denies('gap_do_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapDo->load('team');

        return view('admin.gapDos.edit', compact('gapDo'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            switch ($request->name) {
                case 'evidencia':
                    $gapun = GapDo::findOrFail($id);
                    $gapun->evidencia = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'recomendacion':
                    $gapun = GapDo::findOrFail($id);
                    $gapun->recomendacion = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'valoracion':
                    $gapun = GapDo::findOrFail($id);
                    $gapun->valoracion = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
            }
        }
        //$gapTre->update($request->all());
        //return redirect()->route('admin.gap-tres.index');
    }

    public function show(GapDo $gapDo)
    {
        abort_if(Gate::denies('gap_do_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapDo->load('team');

        return view('admin.gapDos.show', compact('gapDo'));
    }

    public function destroy(GapDo $gapDo)
    {
        abort_if(Gate::denies('gap_do_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapDo->delete();

        return back();
    }

    public function massDestroy(MassDestroyGapDoRequest $request)
    {
        GapDo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function analisis_brecha()
    {
        return $this->belongTo(AnalisisBrecha::class);
    }
}
