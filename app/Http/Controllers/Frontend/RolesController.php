<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Role::with(['permissions'])->select(sprintf('%s.*', (new Role)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'role_show';
                $editGate = 'role_edit';
                $deleteGate = 'role_delete';
                $crudRoutePart = 'roles';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('permissions', function ($row) {
                $labels = [];

                foreach ($row->permissions as $permission) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $permission->name.',');
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'permissions']);

            return $table->make(true);
        }

        $permissions = Permission::get();

        return view('frontend.roles.index', compact('permissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();
        $role = Role::all();

        return view('frontend.roles.create', compact('permissions', 'role'));
    }

    public function validateRol(Request $request)
    {
        $request->validate([
            'nombre_rol' => 'required|string',
            'permissions.*' => 'integer',
            'permissions' => 'required|array',
        ]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            // $this->validateRol($request);
            $nombre_rol = $request->nombre_rol;
            $permissions = $request->permissions;
            $role = Role::create(['title' => $nombre_rol]);
            $role->permissions()->sync($permissions);

            return response()->json(['success' => true]);
        }

        // $role = Role::create($request->all());
        // $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('frontend.roles.index');
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all();
        $role->load('permissions');

        return view('frontend.roles.edit', compact('permissions', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        // dd($request->all());
        if ($request->ajax()) {
            //$this->validateRol($request);
            $nombre_rol = $request->nombre_rol;
            $permissions = $request->permissions;
            $role->update(['title' => $nombre_rol]);
            $role->permissions()->sync($permissions);

            return response()->json(['success' => true]);
        }
        // $role->update($request->all());
        // $role->permissions()->sync($request->input('permissions', []));
        // return redirect()->route('frontend.roles.index');
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->load('permissions');

        return view('frontend.roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getPermissions(Request $request, Role $role)
    {
        if ($request->ajax()) {
            $permissions_role = [];
            foreach ($role->permissions as $permission) {
                $permissions_role[] = $permission->id;
            }

            return $permissions_role;
        }
    }
}
