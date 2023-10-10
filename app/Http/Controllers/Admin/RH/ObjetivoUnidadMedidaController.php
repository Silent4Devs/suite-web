<?php

namespace App\Http\Controllers\admin\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\MetricasObjetivo;
use Illuminate\Http\Request;

class ObjetivoUnidadMedidaController extends Controller
{
    public function index()
    {
        $metricas = MetricasObjetivo::getAll();

        return view('admin.recursos-humanos.evaluacion-360.objetivos.metricas.index', compact('metricas'));
    }

    public function create()
    {
        return view('admin.recursos-humanos.evaluacion-360.objetivos.metricas.create');
    }

    public function store(Request $request)
    {
        $metricas = MetricasObjetivo::create($request->all());

        return redirect()->route('admin.Metrica.index');
    }

    public function edit($metricas)
    {
        $metricas = MetricasObjetivo::find($metricas);

        return view('admin.recursos-humanos.evaluacion-360.objetivos.metricas.edit', compact('metricas'));
    }

    public function update(Request $request, $metricas)
    {
        $metricas = MetricasObjetivo::find($metricas);

        $metricas->update($request->all());

        return redirect()->route('admin.Metrica.index');
    }

    public function show($metricas)
    {
        $metricas = MetricasObjetivo::find($metricas);

        return view('admin.recursos-humanos.evaluacion-360.objetivos.metricas.show', compact('metricas'));
    }

    public function destroy($id)
    {
        $metricas = MetricasObjetivo::find($id);
        $metricas->delete();
        $metricas = MetricasObjetivo::getAll();

        return view('admin.recursos-humanos.evaluacion-360.objetivos.metricas.index', compact('metricas'));
    }
}
