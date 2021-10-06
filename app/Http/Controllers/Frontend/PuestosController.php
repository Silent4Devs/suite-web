<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPuestoRequest;
use App\Http\Requests\StorePuestoRequest;
use App\Http\Requests\UpdatePuestoRequest;
use App\Models\Puesto;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PuestosController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('puesto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puestos = Puesto::all();

        $teams = Team::get();

        return view('frontend.puestos.index', compact('puestos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('puesto_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.puestos.create');
    }

    public function store(StorePuestoRequest $request)
    {
        $puesto = Puesto::create($request->all());

        return redirect()->route('frontend.puestos.index');
    }

    public function edit(Puesto $puesto)
    {
        abort_if(Gate::denies('puesto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->load('team');

        return view('frontend.puestos.edit', compact('puesto'));
    }

    public function update(UpdatePuestoRequest $request, Puesto $puesto)
    {
        $puesto->update($request->all());

        return redirect()->route('frontend.puestos.index');
    }

    public function show(Puesto $puesto)
    {
        abort_if(Gate::denies('puesto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->load('team');

        return view('frontend.puestos.show', compact('puesto'));
    }

    public function destroy(Puesto $puesto)
    {
        abort_if(Gate::denies('puesto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puesto->delete();

        return back();
    }

    public function massDestroy(MassDestroyPuestoRequest $request)
    {
        Puesto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
