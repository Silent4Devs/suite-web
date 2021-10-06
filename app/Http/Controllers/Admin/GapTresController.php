<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGapTreRequest;
use App\Http\Requests\StoreGapTreRequest;
use App\Models\GapTre;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GapTresController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('gap_tre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GapTre::with(['team'])->select(sprintf('%s.*', (new GapTre)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'gap_tre_show';
                $editGate = 'gap_tre_edit';
                $deleteGate = 'gap_tre_delete';
                $crudRoutePart = 'gap-tres';

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
                return $row->valoracion ? GapTre::VALORACION_SELECT[$row->valoracion] : '';
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

        return view('admin.gapTres.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('gap_tre_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gapTres.create');
    }

    public function store(StoreGapTreRequest $request)
    {
        $gapTre = GapTre::create($request->all());

        return redirect()->route('admin.gap-tres.index');
    }

    public function edit(GapTre $gapTre)
    {
        abort_if(Gate::denies('gap_tre_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapTre->load('team');

        return view('admin.gapTres.edit', compact('gapTre'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            switch ($request->name) {
                case 'evidencia':
                    $gapun = GapTre::findOrFail($id);
                    $gapun->evidencia = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'recomendacion':
                    $gapun = GapTre::findOrFail($id);
                    $gapun->recomendacion = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
                case 'valoracion':
                    $gapun = GapTre::findOrFail($id);
                    $gapun->valoracion = $request->value;
                    $gapun->save();

                    return response()->json(['success' => true]);
                    break;
            }
        }
        //$gapTre->update($request->all());
        //return redirect()->route('admin.gap-tres.index');
    }

    public function show(GapTre $gapTre)
    {
        abort_if(Gate::denies('gap_tre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapTre->load('team');

        return view('admin.gapTres.show', compact('gapTre'));
    }

    public function destroy(GapTre $gapTre)
    {
        abort_if(Gate::denies('gap_tre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapTre->delete();

        return back();
    }

    public function massDestroy(MassDestroyGapTreRequest $request)
    {
        GapTre::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
