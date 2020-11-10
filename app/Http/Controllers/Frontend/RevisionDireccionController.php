<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRevisionDireccionRequest;
use App\Http\Requests\StoreRevisionDireccionRequest;
use App\Http\Requests\UpdateRevisionDireccionRequest;
use App\Models\RevisionDireccion;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RevisionDireccionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('revision_direccion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccions = RevisionDireccion::all();

        $teams = Team::get();

        return view('frontend.revisionDireccions.index', compact('revisionDireccions', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('revision_direccion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.revisionDireccions.create');
    }

    public function store(StoreRevisionDireccionRequest $request)
    {
        $revisionDireccion = RevisionDireccion::create($request->all());

        return redirect()->route('frontend.revision-direccions.index');
    }

    public function edit(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_direccion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->load('team');

        return view('frontend.revisionDireccions.edit', compact('revisionDireccion'));
    }

    public function update(UpdateRevisionDireccionRequest $request, RevisionDireccion $revisionDireccion)
    {
        $revisionDireccion->update($request->all());

        return redirect()->route('frontend.revision-direccions.index');
    }

    public function show(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_direccion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->load('team');

        return view('frontend.revisionDireccions.show', compact('revisionDireccion'));
    }

    public function destroy(RevisionDireccion $revisionDireccion)
    {
        abort_if(Gate::denies('revision_direccion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $revisionDireccion->delete();

        return back();
    }

    public function massDestroy(MassDestroyRevisionDireccionRequest $request)
    {
        RevisionDireccion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
