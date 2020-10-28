<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGlosarioRequest;
use App\Http\Requests\StoreGlosarioRequest;
use App\Http\Requests\UpdateGlosarioRequest;
use App\Models\Glosario;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlosarioController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('glosario_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $glosarios = Glosario::all();

        return view('frontend.glosarios.index', compact('glosarios'));
    }

    public function create()
    {
        abort_if(Gate::denies('glosario_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.glosarios.create');
    }

    public function store(StoreGlosarioRequest $request)
    {
        $glosario = Glosario::create($request->all());

        return redirect()->route('frontend.glosarios.index');
    }

    public function edit(Glosario $glosario)
    {
        abort_if(Gate::denies('glosario_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.glosarios.edit', compact('glosario'));
    }

    public function update(UpdateGlosarioRequest $request, Glosario $glosario)
    {
        $glosario->update($request->all());

        return redirect()->route('frontend.glosarios.index');
    }

    public function show(Glosario $glosario)
    {
        abort_if(Gate::denies('glosario_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.glosarios.show', compact('glosario'));
    }

    public function destroy(Glosario $glosario)
    {
        abort_if(Gate::denies('glosario_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $glosario->delete();

        return back();
    }

    public function massDestroy(MassDestroyGlosarioRequest $request)
    {
        Glosario::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
