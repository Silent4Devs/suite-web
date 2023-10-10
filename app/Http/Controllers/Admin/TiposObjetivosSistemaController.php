<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TiposObjetivosSistema;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TiposObjetivosSistemaController extends Controller
{
    use ObtenerOrganizacion;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('tipo_objetivo_sistema_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.tipos_objetivos_sistema.index', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function getDataForDataTable()
    {
        $tipos = TiposObjetivosSistema::all();

        return datatables()->of($tipos)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('tipo_objetivo_sistema_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tiposObjetivosSistema = new TiposObjetivosSistema();

        return view('admin.tipos_objetivos_sistema.create', compact('tiposObjetivosSistema'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::slug($request->nombre, '_');
        $request->merge(['slug' => $slug]);
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:10000',
            'slug' => 'required|max:255|unique:tipo_objetivo_sistema,slug',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'descripcion.max' => 'La descripción no puede tener más de 10000 caracteres',
            'slug.required' => 'El slug es requerido',
            'slug.max' => 'El slug no puede tener más de 255 caracteres',
            'slug.unique' => 'El nombre ya está registrado',
        ]);

        $tipoObjetivoSistema = TiposObjetivosSistema::create($request->all());

        return redirect()->route('admin.tipos-objetivos.index')->with('success', 'Tipo de objetivo del sistema creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TiposObjetivosSistema  $tiposObjetivosSistema
     * @return \Illuminate\Http\Response
     */
    public function show($tiposObjetivosSistema)
    {
        $tiposObjetivosSistema = TiposObjetivosSistema::find($tiposObjetivosSistema);

        // abort_if(Gate::denies('tipo_objetivo_sistema_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.tipos_objetivos_sistema.show', compact('tiposObjetivosSistema'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TiposObjetivosSistema  $tiposObjetivosSistema
     * @return \Illuminate\Http\Response
     */
    public function edit($tiposObjetivosSistema)
    {
        $tiposObjetivosSistema = TiposObjetivosSistema::find($tiposObjetivosSistema);

        //  abort_if(Gate::denies('tipo_objetivo_sistema_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.tipos_objetivos_sistema.edit', compact('tiposObjetivosSistema'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\TiposObjetivosSistema  $tiposObjetivosSistema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tiposObjetivosSistema)
    {
        $tiposObjetivosSistema = TiposObjetivosSistema::find($tiposObjetivosSistema);
        $slug = Str::slug($request->nombre, '_');
        $request->merge(['slug' => $slug]);
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:10000',
            'slug' => 'required|max:255|unique:tipo_objetivo_sistema,slug,' . $tiposObjetivosSistema->id,
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'descripcion.max' => 'La descripción no puede tener más de 10000 caracteres',
            'slug.required' => 'El nombre ya está registrado',
            'slug.max' => 'El slug no puede tener más de 255 caracteres',
        ]);

        $tiposObjetivosSistema->update($request->all());

        return redirect()->route('admin.tipos-objetivos.index')->with('success', 'Tipo de objetivo del sistema actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TiposObjetivosSistema  $tiposObjetivosSistema
     * @return \Illuminate\Http\Response
     */
    public function destroy($tiposObjetivosSistema)
    {
        $tiposObjetivosSistema = TiposObjetivosSistema::find($tiposObjetivosSistema);
        $tiposObjetivosSistema->delete();

        return response()->json(['success' => 'Tipo de objetivo del sistema eliminado con éxito', 'status' => 200]);
    }
}
