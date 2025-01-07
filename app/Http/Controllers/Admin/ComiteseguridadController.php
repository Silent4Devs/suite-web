<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyComiteseguridadRequest;
use App\Http\Requests\UpdateComiteseguridadRequest;
use App\Mail\MemberEmail;
use App\Models\Comiteseguridad;
use App\Models\Empleado;
use App\Models\MiembrosComiteSeguridad;
use App\Models\Team;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComiteseguridadController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('comformacion_comite_seguridad_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Comiteseguridad::with(['miembros' => function ($query) {
                $query->select('name', 'foto');
            }])->orderByDesc('id')->get();

            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'comformacion_comite_seguridad_ver';
                $editGate = 'comformacion_comite_seguridad_editar';
                $deleteGate = 'comformacion_comite_seguridad_eliminar';
                $crudRoutePart = 'comiteseguridads';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nombre_comite', function ($row) {
                return $row->nombre_comite ? $row->nombre_comite : '';
            });
            $table->addColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->rawColumns(['actions', 'placeholder', 'personaasignada']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.comiteseguridads.index', compact('users', 'teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('comformacion_comite_seguridad_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = new Comiteseguridad;

        return view('admin.comiteseguridads.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_comite' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        $comiteseguridad = Comiteseguridad::create($request->all());

        return redirect()->route('admin.comiteseguridads.edit', ['comiteseguridad' => $comiteseguridad]);
    }

    public function edit(Request $request, $comiteseguridad)
    {
        try {
            abort_if(Gate::denies('comformacion_comite_seguridad_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $comiteseguridad = Comiteseguridad::find($comiteseguridad);

            if (! $comiteseguridad) {
                abort(404);
            }

            return view('admin.comiteseguridads.edit', compact('comiteseguridad'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function update(UpdateComiteseguridadRequest $request, $id_comiteseguridad)
    {
        abort_if(Gate::denies('comformacion_comite_seguridad_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre_comite' => 'required|max:255',
            'descripcion' => 'required',
        ]);
        $comiteseguridad = Comiteseguridad::find($id_comiteseguridad);
        $comiteseguridad->update($request->all());

        $miembros = MiembrosComiteSeguridad::where('comite_id', '=', $comiteseguridad->id)->with('asignacion')->get();

        foreach ($miembros as $miembro) {

            $empleado = Empleado::getMyEmpleadodata($miembro->id_asignada);

            if ($empleado) {
                Mail::to($empleado->email)->queue(new MemberEmail($empleado->name, $comiteseguridad->nombre_comite));
            }
        }

        return redirect()->route('admin.comiteseguridads.index')->with('success', 'Editado con éxito');
    }

    public function show($id)
    {
        try {
            abort_if(Gate::denies('comformacion_comite_seguridad_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            // Busca el Comiteseguridad por el ID
            $comiteseguridad = Comiteseguridad::findOrFail($id);

            $datas = MiembrosComiteSeguridad::where('comite_id', $comiteseguridad->id)->with('asignacion')->get();

            $comiteseguridad->load('miembros');

            return view('admin.comiteseguridads.show', compact('comiteseguridad', 'datas'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function destroy($id_comiteseguridad)
    {
        try {
            abort_if(Gate::denies('comformacion_comite_seguridad_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $comiteseguridad = Comiteseguridad::find($id_comiteseguridad);
            $comiteseguridad->delete();

            return back()->with('deleted', 'Registro eliminado con éxito');
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function massDestroy(MassDestroyComiteseguridadRequest $request)
    {
        try {
            Comiteseguridad::whereIn('id', request('ids'))->delete();

            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function saveMember(Request $request, $id_comite)
    {
        try {
            $request->validate([
                'id_asignada' => 'required',
                'nombrerol' => 'required',
                'responsabilidades' => 'required',
            ]);

            $comiteseguridad = Comiteseguridad::findOrFail($id_comite);

            $miembro = MiembrosComiteSeguridad::create([
                'comite_id' => $id_comite,
                'id_asignada' => $request->input('id_asignada'),
                'nombrerol' => $request->input('nombrerol'),
                'responsabilidades' => $request->input('responsabilidades'),
            ]);

            return view('admin.comiteseguridads.edit', compact('comiteseguridad'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function deleteMember($id)
    {

        try {
            $miembros = MiembrosComiteSeguridad::find($id);
            $miembros->forceDelete();

            $comiteseguridad = Comiteseguridad::find($miembros->comite_id);

            return view('admin.comiteseguridads.edit', compact('comiteseguridad'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function visualizacion(Request $request)
    {
        try {
            if ($request->ajax()) {
                $query = Comiteseguridad::with(['miembros' => function ($query) {
                    $query->whereNull('miembros.deleted_at');
                }])
                    ->whereNull('comiteseguridad.deleted_at')
                    ->orderByDesc('comiteseguridad.id')
                    ->get();

                $table = Datatables::of($query);
                $table->addColumn('placeholder', '&nbsp;');
                $table->addColumn('actions', '&nbsp;');

                $table->editColumn('actions', function ($row) {
                    $viewGate = 'comformacion_comite_seguridad_ver';
                    $editGate = 'xx_no_permitido';
                    $deleteGate = 'xx_no_permitido';
                    $crudRoutePart = 'comiteseguridads';

                    return view('partials.datatablesActions', compact(
                        'viewGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'row'
                    ));
                });

                $table->editColumn('nombre_comite', function ($row) {
                    return $row->nombre_comite ? $row->nombre_comite : '';
                });
                $table->addColumn('descripcion', function ($row) {
                    return $row->descripcion ? $row->descripcion : '';
                });
                $table->rawColumns(['actions', 'placeholder', 'personaasignada']);

                return $table->make(true);
            }

            $users = User::getAll();
            $teams = Team::get();
            $organizacion_actual = $this->obtenerOrganizacion();
            $logo_actual = $organizacion_actual->logo;
            $empresa_actual = $organizacion_actual->empresa;

            return view('admin.comiteseguridads.visualizacion', compact('users', 'teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}
