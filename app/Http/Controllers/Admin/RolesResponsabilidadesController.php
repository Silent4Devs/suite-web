<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRolesResponsabilidadeRequest;
use App\Http\Requests\StoreRolesResponsabilidadeRequest;
use App\Http\Requests\UpdateRolesResponsabilidadeRequest;
use App\Models\RolesResponsabilidade;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RolesResponsabilidadesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('roles_responsabilidade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RolesResponsabilidade::with(['team'])->select(sprintf('%s.*', (new RolesResponsabilidade)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'roles_responsabilidade_show';
                $editGate = 'roles_responsabilidade_edit';
                $deleteGate = 'roles_responsabilidade_delete';
                $crudRoutePart = 'roles-responsabilidades';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('responsabilidad', function ($row) {
                return $row->responsabilidad ? $row->responsabilidad : '';
            });
            $table->editColumn('direccionsgsi', function ($row) {
                return $row->direccionsgsi ? $row->direccionsgsi : '';
            });
            $table->editColumn('comiteseguridad', function ($row) {
                return $row->comiteseguridad ? $row->comiteseguridad : '';
            });
            $table->editColumn('responsablesgsi', function ($row) {
                return $row->responsablesgsi ? $row->responsablesgsi : '';
            });
            $table->editColumn('coordinadorsgsi', function ($row) {
                return $row->coordinadorsgsi ? $row->coordinadorsgsi : '';
            });
            $table->editColumn('rol', function ($row) {
                return $row->rol ? $row->rol : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.rolesResponsabilidades.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('roles_responsabilidade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rolesResponsabilidades.create');
    }

    public function store(StoreRolesResponsabilidadeRequest $request)
    {
        $rolesResponsabilidade = RolesResponsabilidade::create($request->all());

        return redirect()->route('admin.roles-responsabilidades.index')->with('success', 'Guardado con éxito');
    }

    public function edit($id_rolesResponsabilidade)
    {
        abort_if(Gate::denies('roles_responsabilidade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rolesResponsabilidade =RolesResponsabilidade::where('id', $id_rolesResponsabilidade)->first();
        $rolesResponsabilidade->load('team');

        return view('admin.rolesResponsabilidades.edit', compact('rolesResponsabilidade'));
    }

    public function update(UpdateRolesResponsabilidadeRequest $request, $id_rolesResponsabilidade)
    {
        $rolesResponsabilidade =RolesResponsabilidade::where('id', $id_rolesResponsabilidade)->first();
        $rolesResponsabilidade->update($request->all());

        return redirect()->route('admin.roles-responsabilidades.index')->with('success', 'Editado con éxito');
    }

    public function show($id_rolesResponsabilidade)
    {
        abort_if(Gate::denies('roles_responsabilidade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rolesResponsabilidade =RolesResponsabilidade::where('id', $id_rolesResponsabilidade)->first();
        $rolesResponsabilidade->load('team');

        return view('admin.rolesResponsabilidades.show', compact('rolesResponsabilidade'));
    }

    public function destroy($id_rolesResponsabilidade)
    {
        abort_if(Gate::denies('roles_responsabilidade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rolesResponsabilidade =RolesResponsabilidade::where('id', $id_rolesResponsabilidade)->first();
        $rolesResponsabilidade->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyRolesResponsabilidadeRequest $request)
    {
        RolesResponsabilidade::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
