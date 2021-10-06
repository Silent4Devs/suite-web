<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrganizacioneRequest;
use App\Http\Requests\StoreOrganizacioneRequest;
use App\Http\Requests\UpdateOrganizacioneRequest;
use App\Models\Organizacione;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class OrganizacionesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('organizacione_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizaciones = Organizacione::all();

        $teams = Team::get();

        return view('frontend.organizaciones.index', compact('organizaciones', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('organizacione_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.organizaciones.create');
    }

    public function store(StoreOrganizacioneRequest $request)
    {
        $organizacione = Organizacione::create($request->all());

        return redirect()->route('frontend.organizaciones.index');
    }

    public function edit(Organizacione $organizacione)
    {
        abort_if(Gate::denies('organizacione_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacione->load('team');

        return view('frontend.organizaciones.edit', compact('organizacione'));
    }

    public function update(UpdateOrganizacioneRequest $request, Organizacione $organizacione)
    {
        $organizacione->update($request->all());

        return redirect()->route('frontend.organizaciones.index');
    }

    public function show(Organizacione $organizacione)
    {
        abort_if(Gate::denies('organizacione_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacione->load('team');

        return view('frontend.organizaciones.show', compact('organizacione'));
    }

    public function destroy(Organizacione $organizacione)
    {
        abort_if(Gate::denies('organizacione_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacione->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrganizacioneRequest $request)
    {
        Organizacione::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
