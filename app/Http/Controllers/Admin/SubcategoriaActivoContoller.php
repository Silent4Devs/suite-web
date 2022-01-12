<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\SubcategoriaActivo;
use App\Models\Team;
use App\Models\Tipoactivo;
use Illuminate\Http\Request;

class SubcategoriaActivoContoller extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {

        // $query = SubcategoriaActivo::with("tipoactivo")->select("*")->orderByDesc('id')->get();
        // dd($query);

        if ($request->ajax()) {
            $query = SubcategoriaActivo::with('tipoactivo')->select('*')->orderByDesc('id');
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'configuracion_tipoactivo_show';
                $editGate = 'configuracion_tipoactivo_edit';
                $deleteGate = 'configuracion_tipoactivo_delete';
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
        $tipos = Tipoactivo::get();

        return view('admin.SubtipoActivos.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $tipos = SubcategoriaActivo::create($request->all());

        return redirect()->route('admin.subtipoactivos.index')->with('success', 'Guardado con éxito');
    }

    public function edit($subcategoria)
    {

        //  $tipos->load('team');
        $subcategoria = SubcategoriaActivo::find($subcategoria);
        $categorias = Tipoactivo::get();

        return view('admin.SubtipoActivos.edit', compact('categorias'))->with('subcategoria', $subcategoria);
    }

    public function update(Request $request, SubcategoriaActivo $subcategoria)
    {
        $subcategoria->update($request->all());

        return redirect()->route('admin.subtipoactivos.index');
    }

    public function show(SubcategoriaActivo $tipos)
    {
        $tipos->load('team');

        return view('admin.SubtipoActivos.show', compact('tipos'));
    }

    public function destroy(SubcategoriaActivo $tipos)
    {
        $tipos->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(Request $request)
    {
        SubcategoriaActivo::whereIn('id', request('ids'))->delete();
    }
}
