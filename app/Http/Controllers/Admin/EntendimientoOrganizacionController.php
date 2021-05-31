<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EntendimientoOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntendimientoOrganizacionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entendimiento_organizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $obtener_FODA = EntendimientoOrganizacion::first();
        return view('admin.entendimientoOrganizacions.index', compact('obtener_FODA'));
    }

    public function create()
    {
        abort_if(Gate::denies('entendimiento_organizacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entendimientoOrganizacion = new EntendimientoOrganizacion;
        return view('admin.entendimientoOrganizacions.create', compact('entendimientoOrganizacion'));
    }

    public function store(Request $request, EntendimientoOrganizacion $entendimientoOrganizacion)
    {

        $request->validate([
            'fortalezas' => 'required|string',
            'debilidades' => 'required|string',
            'oportunidades' => 'required|string',
            'amenazas' => 'required|string',
        ]);
        $entendimientoOrganizacion->create($request->all());

        return redirect()->route('admin.entendimiento-organizacions.index')->with('success', 'Análisis FODA creado correctamente');
    }

    public function edit(EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('entendimiento_organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.entendimientoOrganizacions.edit', compact('entendimientoOrganizacion'));
    }

    public function update(Request $request, EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        $request->validate([
            'fortalezas' => 'required|string',
            'debilidades' => 'required|string',
            'oportunidades' => 'required|string',
            'amenazas' => 'required|string',
        ]);

        $entendimientoOrganizacion->update($request->all());

        return redirect()->route('admin.entendimiento-organizacions.index')->with('success', 'Análisis FODA actualizado correctamente');
    }
}
