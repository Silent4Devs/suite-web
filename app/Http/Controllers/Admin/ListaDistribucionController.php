<?php

namespace App\Http\Controllers\Admin;

use App\Models\ListaDistribucion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ListaDistribucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $query = ListaDistribucion::with('participantes.empleado')->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'incidentes_vacaciones_crear';
                $editGate = 'incidentes_vacaciones_editar';
                $deleteGate = 'incidentes_vacaciones_eliminar';
                $crudRoutePart = 'incidentes-vacaciones';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('modulo', function ($row) {
                return $row->modulo ? $row->modulo : '';
            });
            $table->editColumn('submodulo', function ($row) {
                return $row->submodulo ? $row->submodulo : '';
            });
            $table->editColumn('participantes', function ($row) {
                return $row->participantes ? $row->participantes : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $data['participantes'] = ListaDistribucion::with('participantes.empleado')->get();
        return view('admin.listadistribucion.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ListaDistribucion $listaDistribucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $lista = ListaDistribucion::with('participantes.empleado')->find($id);

        // dd('Llega', $id, $lista_distribucion);
        return view('admin.listadistribucion.edit', compact('lista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ListaDistribucion $listaDistribucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListaDistribucion $listaDistribucion)
    {
        //
    }
}
