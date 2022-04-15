<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPartesInteresadaRequest;
use App\Models\Clausula;
use App\Models\PartesInteresada;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PartesInteresadasController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('partes_interesada_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PartesInteresada::with('clausulas')->select('*')->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'partes_interesada_show';
                $editGate = 'partes_interesada_edit';
                $deleteGate = 'partes_interesada_delete';
                $crudRoutePart = 'partes-interesadas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : '';
            // });
            $table->editColumn('parteinteresada', function ($row) {
                return $row->parteinteresada ? $row->parteinteresada : '';
            });
            $table->editColumn('requisitos', function ($row) {
                return $row->requisitos ? strip_tags($row->requisitos) : '';
            });
            $table->editColumn('clausala', function ($row) {
                return $row->clausulas ? $row->clausulas : '';
            });

            $table->editColumn('norma', function ($row) {
                if (count($row->clausulas)) {
                    $iso = substr($row->clausulas[0]->modulo, 0, 3);
                    $num = substr($row->clausulas[0]->modulo, 3);

                    return $row->clausulas ? strtoupper($iso . ' ' . $num) : '';
                }

                return 'sin clausula';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.partesInteresadas.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('partes_interesada_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $clausulas = Clausula::get();

        return view('admin.partesInteresadas.create', compact('clausulas'));
    }

    public function store(Request $request)
    {
        $partes = PartesInteresada::create($request->all());
        if (array_key_exists('ajax', $request->all())) {
            return response()->json(['success'=>true, 'activo'=>$partes]);
        }

        return redirect()->route('admin.partes-interesadas.edit', ['id'=>$partes]);
    }

    public function edit(Request $request, $id)
    {
        abort_if(Gate::denies('partes_interesada_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $partesInteresada = PartesInteresada::find($id);
        $clausulas = Clausula::get();
        $partesInteresada->load('team');

        return view('admin.partesInteresadas.edit', ['id'=>$partesInteresada], compact('partesInteresada', 'clausulas'));
    }

    public function update(Request $request, PartesInteresada $partesInteresada)
    {
        $partesInteresada->update($request->all());
        $clausulas = Clausula::get();

        return redirect()->route('admin.partes-interesadas.index')->with('success', 'Editado con éxito');
    }

    public function show(PartesInteresada $partesInteresada)
    {
        abort_if(Gate::denies('partes_interesada_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partesInteresada->load('clausulas');

        return view('admin.partesInteresadas.show', compact('partesInteresada'));
    }

    public function destroy(PartesInteresada $partesInteresada)
    {
        abort_if(Gate::denies('partes_interesada_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partesInteresada->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyPartesInteresadaRequest $request)
    {
        PartesInteresada::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
