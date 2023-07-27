<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($request->ajax()) {
            $query = Marca::getAll();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'modelo_show';
                $editGate = 'modelo_edit';
                $deleteGate = 'modelo_delete';
                $crudRoutePart = 'modelo';

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
                return $row->id ? $row->nombre : '';
            });

            $table->editColumn('marca', function ($row) {
                return $row->id ? $row->marca->marca : '';
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        $marca = Marca::getAll();

        return view('admin.modelo.index', compact('marca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marca = Marca::getAll();

        return view('admin.modelo.create', compact('marca'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'nombre' => 'required|string|unique:modelo,nombre',
            ]);
            $nombre = $request->nombre;
            // dd($request->all());
            $modelo = Modelo::create([
                'nombre' => $nombre,
            ]);
            if ($modelo) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo $modelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        $marca = Marca::getAll();

        return view('admin.modelo.edit', compact('tipoactivos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelo $modelo)
    {
        if ($request->ajax()) {
            $request->validate([
                'nombre' => 'required|string|unique:modelo,nombre',
            ]);
            $nombre = $request->nombre;
            // dd($request->all());
            $modelo = Modelo::create([
                'nombre' => $nombre,
            ]);
            if ($modelo) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelo $modelo)
    {
        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyModeloRequest $request)
    {
    }

    public function getModelos(Request $request, $id = null)
    {
        if ($request->ajax()) {
            $modelo_seleccionado = Modelo::getById($id);
            $modelos_arr = [];
            $modelos = Modelo::getAll();
            // dd($marcas);
            foreach ($modelos as $modelo) {
                if ($modelo_seleccionado) {
                    if ($modelo->id == $modelo_seleccionado->id) {
                        $modelos_arr[] = ['id' => $modelo->id, 'text' => $modelo->nombre, 'selected' => true];
                    }
                }
                $modelos_arr[] = ['id' => $modelo->id, 'text' => $modelo->nombre];
            }

            $array_m = [];
            $array_m['results'] = $modelos_arr;
            $array_m['pagination'] = ['more' => false];

            return $array_m;
        }
    }
}
