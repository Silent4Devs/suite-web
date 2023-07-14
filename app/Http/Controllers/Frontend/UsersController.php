<?php

namespace App\Http\Controllers\Frontend;

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
use App\Rules\EmpleadoNoVinculado;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = User::with(['roles', 'organizacion', 'area', 'puesto', 'team', 'empleado' => function ($q) {
                $q->with('area');
            }])->select(sprintf('%s.*', (new User)->table));
            // $table = Datatables::of($query);

            // $table->addColumn('placeholder', '&nbsp;');
            // $table->addColumn('actions', '&nbsp;');

            // $table->editColumn('actions', function ($row) {
            //     $viewGate      = 'user_show';
            //     $editGate      = 'user_edit';
            //     $deleteGate    = 'user_delete';
            //     $crudRoutePart = 'users';
            //     $empleados = Empleado::getAll();
            //     return view('partials.datatablesActions', compact(
            //         'viewGate',
            //         'editGate',
            //         'deleteGate',
            //         'crudRoutePart',
            //         'row',
            //         'empleados'
            //     ));
            // });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : "";
            // });
            // $table->editColumn('name', function ($row) {
            //     return $row->name ? $row->name : "";
            // });
            // $table->editColumn('email', function ($row) {
            //     return $row->email ? $row->email : "";
            // });

            // $table->editColumn('two_factor', function ($row) {
            //     return '<input type="checkbox" disabled ' . ($row->two_factor ? 'checked' : null) . '>';
            // });
            // $table->editColumn('approved', function ($row) {
            //     return '<input type="checkbox" disabled ' . ($row->approved ? 'checked' : null) . '>';
            // });
            // $table->editColumn('verified', function ($row) {
            //     return '<input type="checkbox" disabled ' . ($row->verified ? 'checked' : null) . '>';
            // });
            // $table->editColumn('roles', function ($row) {
            //     $labels = [];

            //     foreach ($row->roles as $role) {
            //         $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
            //     }

            //     return implode(' ', $labels);
            // });
            // $table->addColumn('organizacion_organizacion', function ($row) {
            //     return $row->organizacion ? $row->organizacion->organizacion : '';
            // });

            // $table->addColumn('area_area', function ($row) {
            //     return $row->area ? $row->area->area : '';
            // });

            // $table->addColumn('puesto_puesto', function ($row) {
            //     return $row->puesto ? $row->puesto->puesto : '';
            // });

            // $table->rawColumns(['actions', 'placeholder', 'two_factor', 'approved', 'verified', 'roles', 'organizacion', 'area', 'puesto']);

            // return $table->make(true);
            return datatables()->of($query)->toJson();
        }

        $roles = Role::get();
        $organizaciones = Organizacione::get();
        $areas = Area::getAll();
        $puestos = Puesto::getAll();
        $teams = Team::get();
        $empleadosNoAsignados = Empleado::getAll();
        $empleados = $empleadosNoAsignados->filter(function ($item) {
            return !User::where('n_empleado', $item->n_empleado)->exists();
        })->values();

        return view('frontend.users.index', compact('roles', 'organizaciones', 'areas', 'puestos', 'teams', 'empleados'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $organizacions = Organizacione::all()->pluck('organizacion', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestos = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.users.create', compact('roles', 'organizacions', 'areas', 'puestos', 'teams'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $organizacions = Organizacione::all()->pluck('organizacion', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestos = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'organizacion', 'area', 'puesto', 'team');

        return view('frontend.users.edit', compact('roles', 'organizacions', 'areas', 'puestos', 'teams', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'organizacion', 'area', 'puesto', 'team', 'userUserAlerts');

        return view('frontend.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
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
            $usuarios = User::select('id', 'name', 'email')->where('name', 'LIKE', '%' . $nombre . '%')->take(5)->get();
            $lista = "<ul class='list-group' id='empleados-lista'>";
            foreach ($usuarios as $usuario) {
                $lista .= "<button type='button' class='list-group-item list-group-item-action' onClick='seleccionarUsuario(" . $usuario . ");'>" . $usuario->name . '</button>';
            }
            $lista .= '</ul>';

            return $lista;
        }
    }

    public function vincularEmpleado(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'n_empleado' => ['required', new EmpleadoNoVinculado, 'exists:empleados,n_empleado'],
            ]);
            $usuario = User::find(intval($request->user_id));
            $usuario->update([
                'n_empleado' => $request->n_empleado,
            ]);

            return response()->json(['success' => true]);
        }
    }
}
