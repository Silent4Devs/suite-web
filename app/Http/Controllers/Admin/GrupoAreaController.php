<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGrupoAreaRequest;
use App\Models\Area;
use App\Models\Grupo;
use Gate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class GrupoAreaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('crear_grupo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $grupos = Grupo::orderByDesc('id')->get();

            return datatables()->of($grupos)->toJson();
        }

        return view('admin.grupoarea.index');
    }

    public function create()
    {
        abort_if(Gate::denies('crear_grupo_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.grupoarea.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('crear_grupo_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate(
            [
                'nombre' => 'required|string',
                'descripcion' => 'required|string',
            ],
        );

        $grupoarea = Grupo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'color' => $request->color,
            // 'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
        ]);

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.grupoarea.index')->with('success', 'Guardado con éxito');
    }

    public function show(Grupo $grupoarea)
    {
        abort_if(Gate::denies('crear_grupo_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoarea->load('team');

        return view('admin.grupoarea.show', compact('grupoarea'));
    }

    public function edit(Grupo $grupoarea)
    {
        abort_if(Gate::denies('crear_grupo_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoarea->load('team');

        return view('admin.grupoarea.edit', compact('grupoarea'));
    }

    public function update(Request $request, Grupo $grupoarea)
    {
        abort_if(Gate::denies('crear_grupo_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate(
            [
                'nombre' => 'required|string',
                'descripcion' => 'required|string',
            ],
        );
        $grupoarea->update($request->all());

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.grupoarea.index')->with('success', 'Editado con éxito');
    }

    public function destroy(Grupo $grupoarea)
    {
        abort_if(Gate::denies('crear_grupo_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deleted = $grupoarea->delete();
        if ($deleted) {
            return response()->json(['deleted' => true]);
        } else {
            return response()->json(['deleted' => false]);
        }
    }

    public function massDestroy(MassDestroyGrupoAreaRequest $request)
    {
        Grupo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getRelationatedAreas(Request $request)
    {
        $grupo = Grupo::select('id')->where('id', intval($request->grupo_id))->first();
        $areas = Area::select('area')->where('id_grupo', $grupo->id)->get();

        return $areas;
    }
}
