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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('usuarios_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agregarUsuarios = false;

        $cuentaUsers = User::usuariosActivos();

        $dataCliente = $this->fetchData();

        if ($cuentaUsers <= $dataCliente["numeroUsuarios"]) {
            $agregarUsuarios = true;
        }

        try {
            $existsVinculoEmpleadoAdmin = User::getExists();

            $users = User::getUserWithRole();

            $empleados = Empleado::getAltaDataColumns()->sortBy('name');

            return view('users.tbUsersIndex', compact('users', 'existsVinculoEmpleadoAdmin', 'empleados', 'agregarUsuarios'));
        } catch (\Exception $e) {
            // Registrar el error en los logs
            Log::channel('logstash')->info('Error al cargar usuarios: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al cargar usuarios'], 500);
        }
    }

    public function getUsersIndex(Request $request)
    {
        try {

            $key = 'Users:users_index_data';

            $query = Cache::remember($key, now()->addMinutes(120), function () {
                return User::with(['roles', 'organizacion', 'area', 'puesto', 'team', 'empleado' => function ($q) {
                    $q->with('area');
                }])->get();
            });

            return datatables()->of($query)->toJson();
        } catch (\Exception $e) {
            // Registrar el error en los logs
            Log::channel('logstash')->info('Error al cargar usuarios: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al cargar usuarios'], 500);
        }
    }

    public function create()
    {
        try {

            abort_if(Gate::denies('usuarios_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $roles = Role::getAll()->pluck('title', 'id');

            $organizacions = Organizacione::all()->pluck('organizacion', 'id')->prepend(trans('global.pleaseSelect'), '');

            $areas = Area::getAllPluck();

            $puestos = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

            $teams = Team::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

            return view('users.tbUsersCreate', compact('roles', 'organizacions', 'areas', 'puestos', 'teams'));
        } catch (\Exception $e) {
            // Registrar el error en los logs
            Log::channel('logstash')->info('Error al crear usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al crear usuario'], 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            abort_if(Gate::denies('usuarios_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $user = User::create($request->all());
            $user->roles()->sync($request->input('roles', []));
            Alert::success('éxito', 'Información añadida con éxito');

            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::channel('logstash')->info('Error al guardar usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al guardar usuario'], 500);
        }
    }

    public function edit(User $user)
    {
        try {
            abort_if(Gate::denies('usuarios_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $roles = Role::getAll()->pluck('title', 'id');

            $organizacions = Organizacione::all()->pluck('organizacion', 'id')->prepend(trans('global.pleaseSelect'), '');

            $areas = Area::getAllPluck();

            $puestos = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

            $teams = Team::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

            $user->load('roles', 'organizacion', 'area', 'puesto', 'team');

            return view('users.tbUsersUpdate', compact('roles', 'organizacions', 'areas', 'puestos', 'teams', 'user'));
        } catch (\Exception $e) {
            Log::channel('logstash')->info('Error al editar usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al editar usuario'], 500);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            abort_if(Gate::denies('usuarios_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $user->update($request->all());
            $user->roles()->sync($request->roles);
            Alert::success('éxito', 'Información añadida con éxito');

            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::channel('logstash')->info('Error al actualizar usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al actualizar usuario'], 500);
        }
    }

    public function show(User $user)
    {
        try {
            abort_if(Gate::denies('usuarios_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $user->load('roles', 'organizacion', 'area', 'puesto', 'team', 'userUserAlerts');

            return view('users.tbUserShow', compact('user'));
        } catch (\Exception $e) {
            Log::channel('logstash')->info('Error al mostrar usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al mostrar usuario'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            abort_if(Gate::denies('usuarios_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $registro = User::find($id);

            if (! $registro) {
                return response()->json(['status' => 'error', 'message' => 'Registro no encontrado.'], 404);
            }

            $registro->delete();

            return response()->json(['status' => 'success', 'message' => 'El registro ha sido eliminado con éxito.']);
        } catch (\Exception $e) {
            Log::channel('logstash')->info('Error al eliminar usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al eliminar usuario'], 500);
        }
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        try {
            User::whereIn('id', request('ids'))->delete();

            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            Log::channel('logstash')->info('Error al eliminar usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al eliminar usuario'], 500);
        }
    }

    public function getUsers(Request $request)
    {
        try {
            if ($request->ajax()) {
                $nombre = $request->nombre;
                $usuarios = User::getAll()->where('name', 'LIKE', '%' . $nombre . '%')->take(5);
                $lista = "<ul class='list-group' id='empleados-lista'>";
                foreach ($usuarios as $usuario) {
                    $lista .= "<button type='button' class='list-group-item list-group-item-action' onClick='seleccionarUsuario(" . $usuario . ");'>" . $usuario->name . '</button>';
                }
                $lista .= '</ul>';

                return $lista;
            }
        } catch (\Exception $e) {
            Log::channel('logstash')->info('Error al obtener usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);

            // Retornar una respuesta de error al cliente
            return response()->json(['message' => 'Error al obtener usuario'], 500);
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

    public function cambiarVerificacion(User $user)
    {
        if ($user->two_factor) {
            $message = "Verificación por dos factores deshabilitada para el usuario {$user->name}";
        } else {
            $message = "Verificación por dos factores habilitada para el usuario {$user->name}";
        }

        $user->two_factor = ! $user->two_factor;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', $message);
    }

    public function toogleBloqueo(User $user)
    {
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

    public function fetchData()
    {
        try {
            // Realiza la solicitud GET a la API externa
            $response = Http::get('https://66d8dc314ad2f6b8ed52d80a.mockapi.io/example2');

            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                // Procesa los datos si es necesario y devuelve la respuesta
                $data = $response->json();
                // Retornar los datos procesados o directamente
                return $data[0];
            }

            // Si la solicitud no fue exitosa, maneja el error
            return response()->json([
                'message' => 'Error al obtener los datos de la API externa',
                'status' => $response->status(),
                'error' => $response->body(),
            ], $response->status());
        } catch (\Exception $e) {
            // Manejo de excepciones genéricas
            return response()->json([
                'message' => 'Hubo un error al intentar conectar con la API externa',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
