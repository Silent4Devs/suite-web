<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('roles_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Role::getAll();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'roles_ver';
                $editGate = 'roles_editar';
                $deleteGate = 'roles_eliminar';
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
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $permission->name . ',');
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'permissions']);

            return $table->make(true);
        }

        $permissions = Permission::getAll();

        return view('admin.roles.index', compact('permissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('roles_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::getAll();
        $role = Role::getAll();

        return view('admin.roles.create', compact('permissions', 'role'));
    }

    public function validateRol(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'permissions.*' => 'integer',
            'permissions' => 'required|array',
        ]);
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('roles_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre_rol' => 'required|string|min:3|max:255|unique:roles,title,NULL,id,deleted_at,NULL',
        ]);
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
        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('roles_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::getAll();
        $role->load('permissions');

        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        abort_if(Gate::denies('roles_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre_rol' => "required|string|min:3|max:255|unique:roles,title,{$role->id},id,deleted_at,NULL",
        ]);
        if ($request->ajax()) {
            $nombre_rol = $request->nombre_rol;
            $permissions = $request->permissions;
            $role->update(['title' => $nombre_rol]);
            $role->permissions()->sync($permissions);

            return response()->json(['success' => true]);
        }
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('roles_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('roles_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->delete();

        return back();
    }

    public function copiarRol(Role $role, Request $request)
    {
        abort_if(Gate::denies('roles_copiar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre_rol' => 'required|string|min:3|max:255|unique:roles,title,NULL,id,deleted_at,NULL',
        ]);
        $nombre_rol = $request->nombre_rol;
        $rol_copiar = $role->replicate();
        $rol_copiar->title = $nombre_rol;
        $rol_copiar->created_at = Carbon::now();
        $rol_copiar->updated_at = Carbon::now();
        $rol_copiar->save();
        $rol_copiar->permissions()->sync($role->permissions);

        return response()->json(['success' => true, 'rol_creado' => $rol_copiar]);
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
