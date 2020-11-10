<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyObjetivosseguridadRequest;
use App\Http\Requests\StoreObjetivosseguridadRequest;
use App\Http\Requests\UpdateObjetivosseguridadRequest;
use App\Models\Objetivosseguridad;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ObjetivosseguridadController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('objetivosseguridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridads = Objetivosseguridad::all();

        $teams = Team::get();

        return view('frontend.objetivosseguridads.index', compact('objetivosseguridads', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('objetivosseguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.objetivosseguridads.create');
    }

    public function store(StoreObjetivosseguridadRequest $request)
    {
        $objetivosseguridad = Objetivosseguridad::create($request->all());

        return redirect()->route('frontend.objetivosseguridads.index');
    }

    public function edit(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivosseguridad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridad->load('team');

        return view('frontend.objetivosseguridads.edit', compact('objetivosseguridad'));
    }

    public function update(UpdateObjetivosseguridadRequest $request, Objetivosseguridad $objetivosseguridad)
    {
        $objetivosseguridad->update($request->all());

        return redirect()->route('frontend.objetivosseguridads.index');
    }

    public function show(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivosseguridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridad->load('team');

        return view('frontend.objetivosseguridads.show', compact('objetivosseguridad'));
    }

    public function destroy(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivosseguridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridad->delete();

        return back();
    }

    public function massDestroy(MassDestroyObjetivosseguridadRequest $request)
    {
        Objetivosseguridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
