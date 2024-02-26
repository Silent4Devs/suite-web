<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\CatalogoRangosObjetivos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CatalogoRangosObjetivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        abort_if(Gate::denies('objetivos_estrategicos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catalogos = CatalogoRangosObjetivos::with('rangos')->get();

        return view('admin.recursos-humanos.evaluacion-360.objetivos.rangos.index', compact('catalogos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        abort_if(Gate::denies('objetivos_estrategicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.recursos-humanos.evaluacion-360.objetivos.rangos.create');
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
    public function show(CatalogoRangosObjetivos $catalogoRangosObjetivos)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($cat_id)
    {
        //
        abort_if(Gate::denies('objetivos_estrategicos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.recursos-humanos.evaluacion-360.objetivos.rangos.edit', compact('cat_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CatalogoRangosObjetivos $catalogoRangosObjetivos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('objetivos_estrategicos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catalogoRangosObjetivos = CatalogoRangosObjetivos::find($id);

        if (!$catalogoRangosObjetivos) {
            return response()->json(['error' => 'Catalogo no encontrado.'], 404);
        }

        try {
            $catalogoRangosObjetivos->delete();

            return response()->json(['message' => 'Catalogo borrado exitosamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha habido un error al tratar de borrar el catalogo..'], 500);
        }
    }
}
