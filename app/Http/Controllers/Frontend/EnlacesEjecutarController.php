<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnlacesEjecutarRequest;
use App\Http\Requests\StoreEnlacesEjecutarRequest;
use App\Http\Requests\UpdateEnlacesEjecutarRequest;
use App\Models\EnlacesEjecutar;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnlacesEjecutarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('enlaces_ejecutar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enlacesEjecutars = EnlacesEjecutar::all();

        $teams = Team::get();

        return view('frontend.enlacesEjecutars.index', compact('enlacesEjecutars', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('enlaces_ejecutar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.enlacesEjecutars.create');
    }

    public function store(StoreEnlacesEjecutarRequest $request)
    {
        $enlacesEjecutar = EnlacesEjecutar::create($request->all());

        return redirect()->route('frontend.enlaces-ejecutars.index');
    }

    public function edit(EnlacesEjecutar $enlacesEjecutar)
    {
        abort_if(Gate::denies('enlaces_ejecutar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enlacesEjecutar->load('team');

        return view('frontend.enlacesEjecutars.edit', compact('enlacesEjecutar'));
    }

    public function update(UpdateEnlacesEjecutarRequest $request, EnlacesEjecutar $enlacesEjecutar)
    {
        $enlacesEjecutar->update($request->all());

        return redirect()->route('frontend.enlaces-ejecutars.index');
    }

    public function show(EnlacesEjecutar $enlacesEjecutar)
    {
        abort_if(Gate::denies('enlaces_ejecutar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enlacesEjecutar->load('team');

        return view('frontend.enlacesEjecutars.show', compact('enlacesEjecutar'));
    }

    public function destroy(EnlacesEjecutar $enlacesEjecutar)
    {
        abort_if(Gate::denies('enlaces_ejecutar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enlacesEjecutar->delete();

        return back();
    }

    public function massDestroy(MassDestroyEnlacesEjecutarRequest $request)
    {
        EnlacesEjecutar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
