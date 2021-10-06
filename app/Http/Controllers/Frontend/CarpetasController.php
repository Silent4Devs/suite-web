<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarpetumRequest;
use App\Http\Requests\StoreCarpetumRequest;
use App\Http\Requests\UpdateCarpetumRequest;
use App\Models\Carpetum;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CarpetasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpetum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpeta = Carpetum::all();

        $teams = Team::get();

        return view('frontend.carpeta.index', compact('carpeta', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('carpetum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.carpeta.create');
    }

    public function store(StoreCarpetumRequest $request)
    {
        $carpetum = Carpetum::create($request->all());

        return redirect()->route('frontend.carpeta.index');
    }

    public function edit(Carpetum $carpetum)
    {
        abort_if(Gate::denies('carpetum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpetum->load('team');

        return view('frontend.carpeta.edit', compact('carpetum'));
    }

    public function update(UpdateCarpetumRequest $request, Carpetum $carpetum)
    {
        $carpetum->update($request->all());

        return redirect()->route('frontend.carpeta.index');
    }

    public function show(Carpetum $carpetum)
    {
        abort_if(Gate::denies('carpetum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpetum->load('team');

        return view('frontend.carpeta.show', compact('carpetum'));
    }

    public function destroy(Carpetum $carpetum)
    {
        abort_if(Gate::denies('carpetum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpetum->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarpetumRequest $request)
    {
        Carpetum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
