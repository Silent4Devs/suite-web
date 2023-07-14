<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\SubcategoriaActivo;
use App\Models\Team;
use App\Models\Tipoactivo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubcategoriaActivoContoller extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('subcategoria_activos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubcategoriaActivo::with('tipoactivo')->select('*')->orderByDesc('id');
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'subcategoria_activos_ver';
                $editGate = 'subcategoria_activos_editar';
                $deleteGate = 'subcategoria_activos_eliminar';
                $crudRoutePart = 'subtipoactivos';

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
            $table->editColumn('tipo', function ($row) {
                return $row->tipoactivo ? $row->tipoactivo->tipo : '';
            });
            $table->editColumn('subtipo', function ($row) {
                return $row->subcategoria ? $row->subcategoria : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.SubtipoActivos.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('subcategoria_activos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tipos = Tipoactivo::getAll();

        return view('admin.SubtipoActivos.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('subcategoria_activos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'categoria_id' => 'required|int',
        ]);

        $subtipos = SubcategoriaActivo::create($request->all());
        if (array_key_exists('ajax', $request->all())) {
            return response()->json(['success'=>true, 'subtipo'=>$subtipos]);
        }

        return redirect()->route('admin.subtipoactivos.index')->with('success', 'Guardado con éxito');
    }

    public function edit($subcategoria)
    {
        abort_if(Gate::denies('subcategoria_activos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subcategoria = SubcategoriaActivo::find($subcategoria);
        $categorias = Tipoactivo::getAll();

        return view('admin.SubtipoActivos.edit', compact('categorias'))->with('subcategoria', $subcategoria);
    }

    public function update(Request $request, $subcategoria)
    {
        abort_if(Gate::denies('subcategoria_activos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subcategoria = SubcategoriaActivo::find($subcategoria);

        $subcategoria->update($request->all());

        return redirect()->route('admin.subtipoactivos.index');
    }

    public function show(Request $request, $subcategoria)
    {
        abort_if(Gate::denies('subcategoria_activos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subcategoria = SubcategoriaActivo::with('tipoactivo')->find($subcategoria);

        return view('admin.SubtipoActivos.show', compact('subcategoria'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('subcategoria_activos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subcategoria = SubcategoriaActivo::find($id);
        $subcategoria->delete();
        $subcategoria = SubcategoriaActivo::getAll();

        return view('admin.SubtipoActivos.index', compact('subcategoria'));
    }

    public function massDestroy(Request $request)
    {
        SubcategoriaActivo::whereIn('id', request('ids'))->delete();
    }

    public function getSubtipos(Request $request)
    {
        if ($request->ajax()) {
            $subtipos_arr = [];
            $subtipos = SubcategoriaActivo::where('categoria_id', $request->categoria)->get();
            // dd($tipos);
            foreach ($subtipos as $subtipo) {
                $subtipos_arr[] = ['id'=>$subtipo->id, 'text'=>$subtipo->categoria_id, 'text'=>$subtipo->subcategoria];
            }

            $array_m = [];
            $array_m['results'] = $subtipos_arr;
            $array_m['pagination'] = ['more'=>false];

            return $array_m;
        }
    }
}
