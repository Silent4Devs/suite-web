<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacione;
use App\Models\Puesto;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('usuarios_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $existsVinculoEmpleadoAdmin = User::getExists();

        $users = User::getUserWithRole();

        $empleados = Empleado::getAltaDataColumns()->sortBy('name');

        return view('users.tbUsersIndex', compact('users', 'existsVinculoEmpleadoAdmin', 'empleados'));
    }

    public function getUsersIndex(Request $request)
    {
        $key = 'Users:users_index_data';

        $query = Cache::remember($key, now()->addMinutes(120), function () {
            return User::with(['roles', 'organizacion', 'area', 'puesto', 'team', 'empleado' => function ($q) {
                $q->with('area');
            }])->get();
        });

        return datatables()->of($query)->toJson();
    }

    public function create()
    {

        abort_if(Gate::denies('usuarios_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::getAll()->pluck('title', 'id');

        $organizacions = Organizacione::all()->pluck('organizacion', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::getAllPluck();

        $puestos = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleados = Empleado::getIdNameAll()->sortBy('name');

        return view('users.tbUsersCreate', compact('roles', 'organizacions', 'areas', 'puestos', 'teams', 'empleados'));
    }

    public function store(StoreUserRequest $request)
    {
        abort_if(Gate::denies('usuarios_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.users.index');
    }

    public function edit($id_user)
    {
        abort_if(Gate::denies('usuarios_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::where('id', $id_user)->first();

        $roles = Role::getAll()->pluck('title', 'id');

        $organizacions = Organizacione::all()->pluck('organizacion', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::getAllPluck();

        $puestos = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'organizacion', 'area', 'puesto', 'team');

        $empleados = Empleado::getIdNameAll()->sortBy('name');

        return view('users.tbUsersUpdate', compact('roles', 'organizacions', 'areas', 'puestos', 'teams', 'user', 'empleados'));
    }

    public function update(UpdateUserRequest $request, $id_user)
    {
        abort_if(Gate::denies('usuarios_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::where('id', $id_user)->first();

        $user->update($request->all());
        $user->roles()->sync($request->roles);

        // Verificar si el usuario tiene un empleado asociado
        if ($user->empleado) {
            $user->empleado->update(['email' => $user->email]);
        }

        Alert::success('Éxito', 'Información actualizada con éxito');

        return redirect()->route('admin.users.index');
    }

    public function show($id_user)
    {
        abort_if(Gate::denies('usuarios_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::where('id', $id_user)->first();

        $user->load('roles', 'organizacion', 'area', 'puesto', 'team', 'userUserAlerts');

        return view('users.tbUserShow', compact('user'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('usuarios_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $registro = User::find($id);

        if (! $registro) {
            return response()->json(['status' => 'error', 'message' => 'Registro no encontrado.'], 404);
        }

        $registro->delete();

        return response()->json(['status' => 'success', 'message' => 'El registro ha sido eliminado con éxito.']);
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $nombre = $request->nombre;
            $usuarios = User::getAll()->where('name', 'LIKE', '%'.$nombre.'%')->take(5);
            $lista = "<ul class='list-group' id='empleados-lista'>";
            foreach ($usuarios as $usuario) {
                $lista .= "<button type='button' class='list-group-item list-group-item-action' onClick='seleccionarUsuario(".$usuario.");'>".$usuario->name.'</button>';
            }
            $lista .= '</ul>';

            return $lista;
        }
    }

    public function vincularEmpleado(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'id_empleado' => ['required'],
            ]);
            $usuario = User::find(intval($request->user_id));

            $usuario->update([
                'empleado_id' => $request->id_empleado,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function cambiarVerificacion($id_user)
    {
        $user = User::where('id', $id_user)->first();

        if ($user->two_factor) {
            $message = "Verificación por dos factores deshabilitada para el usuario {$user->name}";
        } else {
            $message = "Verificación por dos factores habilitada para el usuario {$user->name}";
        }

        $user->two_factor = ! $user->two_factor;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', $message);
    }

    public function toogleBloqueo($id_user)
    {
        $user = User::where('id', $id_user)->first();

        if ($user->is_active) {
            $message = "El usuario {$user->name} ha sido bloqueado";
        } else {
            $message = "El usuario {$user->name} ha sido desbloqueado";
        }

        $user->is_active = ! $user->is_active;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', $message);
    }

    // Funcion para restablecer usuario eliminado
    public function restablecerUsuario($id)
    {
        $usuario = User::withTrashed()->find($id);

        if ($usuario != null) {
            $usuario = User::withTrashed()->find($id)->restore();
            Alert::success('éxito', 'Restablecido con éxito');

            return redirect()->route('admin.users.index');
        } else {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.users.index'));
        }
    }

    public function vistaEliminados()
    {
        $usuarios = User::withTrashed()->where('deleted_at', '<>', null)->get();

        return view('admin.users.eliminados', compact('usuarios'));
    }
}
