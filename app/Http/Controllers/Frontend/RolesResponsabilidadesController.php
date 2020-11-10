<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRolesResponsabilidadeRequest;
use App\Http\Requests\StoreRolesResponsabilidadeRequest;
use App\Http\Requests\UpdateRolesResponsabilidadeRequest;
use App\Models\RolesResponsabilidade;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolesResponsabilidadesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('roles_responsabilidade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rolesResponsabilidades = RolesResponsabilidade::all();

        $teams = Team::get();

        return view('frontend.rolesResponsabilidades.index', compact('rolesResponsabilidades', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('roles_responsabilidade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.rolesResponsabilidades.create');
    }

    public function store(StoreRolesResponsabilidadeRequest $request)
    {
        $rolesResponsabilidade = RolesResponsabilidade::create($request->all());

        return redirect()->route('frontend.roles-responsabilidades.index');
    }

    public function edit(RolesResponsabilidade $rolesResponsabilidade)
    {
        abort_if(Gate::denies('roles_responsabilidade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rolesResponsabilidade->load('team');

        return view('frontend.rolesResponsabilidades.edit', compact('rolesResponsabilidade'));
    }

    public function update(UpdateRolesResponsabilidadeRequest $request, RolesResponsabilidade $rolesResponsabilidade)
    {
        $rolesResponsabilidade->update($request->all());

        return redirect()->route('frontend.roles-responsabilidades.index');
    }

    public function show(RolesResponsabilidade $rolesResponsabilidade)
    {
        abort_if(Gate::denies('roles_responsabilidade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rolesResponsabilidade->load('team');

        return view('frontend.rolesResponsabilidades.show', compact('rolesResponsabilidade'));
    }

    public function destroy(RolesResponsabilidade $rolesResponsabilidade)
    {
        abort_if(Gate::denies('roles_responsabilidade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rolesResponsabilidade->delete();

        return back();
    }

    public function massDestroy(MassDestroyRolesResponsabilidadeRequest $request)
    {
        RolesResponsabilidade::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
