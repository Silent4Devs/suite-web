<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\PerfilEmpleado;
use App\Models\Puesto;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionesEvaluados;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\Objetivo;
use App\Models\RH\ObjetivoEmpleado;
use App\Models\RH\ObjetivoRespuesta;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;

class EV360ObjetivosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('objetivos_estrategicos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuario = User::getCurrentUser();
        $empleados = Empleado::getaltaAllWithAreaObjetivoPerfil();
        $isAdmin = in_array('Admin', $usuario->roles->pluck('title')->toArray());

        $areas = Area::getAll();
        $puestos = Puesto::getAll();
        $perfiles = PerfilEmpleado::getAll();
        // dd(
        //     $usuario,
        //     $empleados,
        //     $isAdmin
        // );
        if ($usuario->empleado->children->count() > 0 && ! $isAdmin) {
            // dd('Caso 1');
            $empleados = $usuario->empleado->children;

            return view('admin.recursos-humanos.evaluacion-360.objetivos.index', compact('areas', 'puestos', 'perfiles', 'empleados'));
            // return datatables()->of($usuario->empleado->children)->toJson();
        } elseif ($isAdmin) {
            // dd('caso 2');
            return view('admin.recursos-humanos.evaluacion-360.objetivos.index', compact('areas', 'puestos', 'perfiles', 'empleados'));
            // return datatables()->of($empleados)->toJson();
        } else {
            // dd('caso 3');
            return view('admin.recursos-humanos.evaluacion-360.objetivos.index', compact('areas', 'puestos', 'perfiles', 'empleados'));
            // return datatables()->of($empleados)->toJson();
        }

        // if ($request->ajax()) {
        //     $usuario = User::getCurrentUser();
        //     $empleados = Empleado::getaltaAllWithAreaObjetivoPerfil();
        //     $isAdmin = in_array('Admin', $usuario->roles->pluck('title')->toArray());
        //     if ($usuario->empleado->children->count() > 0 && !$isAdmin) {
        //         return datatables()->of($usuario->empleado->children)->toJson();
        //     } elseif ($isAdmin) {
        //         return datatables()->of($empleados)->toJson();
        //     } else {
        //         return datatables()->of($empleados)->toJson();
        //     }
        // }

        // return view('admin.recursos-humanos.evaluacion-360.objetivos.index', compact('areas', 'puestos', 'perfiles'));
    }

    public function create()
    {
        abort_if(Gate::denies('objetivos_estrategicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.recursos-humanos.evaluacion-360.objetivos.objetivos-negocio');
    }

    public function createByEmpleado(Request $request, $empleado)
    {
        if (filter_var($empleado, FILTER_VALIDATE_INT) !== false && $empleado >= 0) {
            try {
                $user = User::getCurrentUser();
                if ($user->empleado->id == $empleado) {
                    $objetivo = new Objetivo;

                    $empleado = Empleado::select('id', 'name', 'foto', 'area_id', 'puesto_id', 'supervisor_id')
                    ->with([
                        'objetivos' => function ($query) {
                            $query->with([
                                'objetivo' => function ($nestedQuery) {
                                    $nestedQuery->with(['tipo', 'metrica']);
                                }
                            ]);
                        }
                    ])->where('estatus', 'alta')
                    ->find(intval($empleado));


                    $objetivos = $empleado->objetivos ? $empleado->objetivos : collect();

                    $tipo_seleccionado = null;
                    $metrica_seleccionada = null;

                    $empleados = Empleado::getAltaDataColumns();

                    $permiso = $user->can('aprobacion_objetivos_estrategicos');

                    return view('admin.recursos-humanos.evaluacion-360.objetivos.create-by-empleado', compact('objetivo','objetivos', 'tipo_seleccionado', 'metrica_seleccionada', 'empleado', 'empleados', 'permiso'));
                } else {
                    abort_if(Gate::denies('objetivos_estrategicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
                    $objetivo = new Objetivo;

                    $empleado = Empleado::select('id', 'name', 'foto', 'area_id', 'puesto_id', 'supervisor_id')
                    ->with([
                        'objetivos' => function ($query) {
                            $query->with([
                                'objetivo' => function ($nestedQuery) {
                                    $nestedQuery->with(['tipo', 'metrica']);
                                }
                            ]);
                        }
                    ])->where('estatus', 'alta')
                    ->find(intval($empleado));

                    $objetivos = $empleado->objetivos ? $empleado->objetivos : collect();

                    $tipo_seleccionado = null;
                    $metrica_seleccionada = null;

                    $empleados = Empleado::getAltaDataColumns();
                    $permiso = $user->can('aprobacion_objetivos_estrategicos');

                    // dd($permiso);
                    return view('admin.recursos-humanos.evaluacion-360.objetivos.create-by-empleado', compact('objetivo' ,'objetivos','tipo_seleccionado', 'metrica_seleccionada', 'empleado', 'empleados', 'permiso'));
                }
            } catch (\Throwable $th) {
                dd( $th);
            }
        } else {
            // El valor no es válido, maneja el error
            dd('error');
        }
    }

    public function storeByEmpleado(Request $request, $empleado)
    {
        try {
            abort_if(Gate::denies('objetivos_estrategicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $request->validate([
                'nombre' => 'required|string|max:255',
                'KPI' => 'required|string|max:1500',
                'meta' => 'required|integer|min:0',
                'descripcion_meta' => 'nullable|string|max:1500',
                'tipo_id' => 'required|exists:ev360_tipo_objetivos,id',
                'metrica_id' => 'required|exists:ev360_metricas_objetivos,id',
            ]);
            $empleado = Empleado::with('supervisor')->find(intval($empleado));

            if (! $empleado) {
                abort(404);
            }

            if ($request->ajax()) {
                $usuario = User::getCurrentUser();
                if ($empleado->id == $usuario->empleado->id || $usuario->empleado->id != $empleado->supervisor->id) {
                    //add esta_aprobado in $request
                    $request->merge(['esta_aprobado' => Objetivo::SIN_DEFINIR]);
                }
                $objetivo = Objetivo::create($request->all());

                if ($request->hasFile('foto')) {
                    Storage::makeDirectory('public/objetivos/img'); //Crear si no existe
                    $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
                    $nombre_imagen = 'OBJETIVO_'.$objetivo->id.'_'.$objetivo->nombre.'EMPLEADO_'.$empleado->id.'.'.$extension;
                    $route = storage_path().'/app/public/objetivos/img/'.$nombre_imagen;

                    // Call the ImageService to consume the external API
                    $apiResponse = ImageService::consumeImageCompresorApi($request->file('foto'));

                    // Compress and save the image
                    if ($apiResponse['status'] == 200) {
                        file_put_contents($route, $apiResponse['body']);
                    }

                    $objetivo->update([
                        'imagen' => $nombre_imagen,
                    ]);
                }
                ObjetivoEmpleado::create([
                    'objetivo_id' => $objetivo->id,
                    'empleado_id' => $empleado->id,
                ]);

                $ev = $this->evaluacionActiva();

                if (isset($ev->id)) {
                    $evaluacion = EvaluacionesEvaluados::where('evaluacion_id', '=', $ev->id)->get();

                    foreach ($evaluacion as $evalu) {
                        $evaluado = ObjetivoEmpleado::where('objetivo_id', '=', $objetivo->id)
                            ->where('empleado_id', '=', $evalu->evaluado_id)
                            ->where('en_curso', '=', true)->get();

                        foreach ($evaluado as $eva) {
                            $evaluador = EvaluadoEvaluador::where('evaluado_id', '=', $evalu->evaluado_id)
                                ->where('evaluacion_id', '=', $ev->id)
                                ->whereIn('tipo', ['0', '1'])->get();

                            foreach ($evaluador as $evldr) {
                                ObjetivoRespuesta::create([
                                    'meta_alcanzada' => 'Sin evaluar',
                                    'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
                                    'calificacion' => 0,
                                    'objetivo_id' => $objetivo->id,
                                    'evaluado_id' => $eva->empleado_id,
                                    'evaluador_id' => $evldr->evaluador_id,
                                    'evaluacion_id' => $ev->id,
                                ]);
                            }
                        }
                    }
                }

                Artisan::call('optimize:clear');

                if ($objetivo) {
                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['error' => true]);
                }
            }
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('objetivos_estrategicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'KPI' => 'required|string|max:1500',
            'meta' => 'required|integer',
            'descripcion_meta' => 'nullable|string|max:1500',
            'tipo_id' => 'required|exists:ev360_tipo_objetivos,id',
            'metrica_id' => 'required|exists:ev360_metricas_objetivos,id',
        ]);

        $objetivo = Objetivo::create($request->all());
        if ($objetivo) {
            return redirect()->route('admin.ev360-objetivos.index');
        } else {
            return redirect()->route('admin.ev360-objetivos.index')->with('error', 'Ocurrió un error al crear el objetivo, intente de nuevo...');
        }

    }

    public function aprobarRechazarObjetivo(Request $request, $empleado, $objetivo)
    {
        $aprobacion = $request->esta_aprobado ? Objetivo::APROBADO : Objetivo::RECHAZADO;
        $objetivo = Objetivo::find(intval($objetivo));
        $objetivo->update([
            'esta_aprobado' => $aprobacion,
            'comentarios_aprobacion' => $request->comentarios_aprobacion,
        ]);
        //Creacion de objetivos
        $ev = $this->evaluacionActiva();

        if ($objetivo->esta_aprobado == '1' && isset($ev->id)) {
            $evaluacion = EvaluacionesEvaluados::where('evaluacion_id', '=', $ev->id)->get();

            foreach ($evaluacion as $evalu) {
                $evaluado = ObjetivoEmpleado::where('objetivo_id', '=', $objetivo->id)
                    ->where('empleado_id', '=', $evalu->evaluado_id)
                    ->where('en_curso', '=', true)->get();

                foreach ($evaluado as $eva) {
                    $evaluador = EvaluadoEvaluador::where('evaluado_id', '=', $evalu->evaluado_id)
                        ->where('evaluacion_id', '=', $ev->id)
                        ->whereIn('tipo', ['0', '1'])->get();

                    foreach ($evaluador as $evldr) {
                        ObjetivoRespuesta::create([
                            'meta_alcanzada' => 'Sin evaluar',
                            'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
                            'calificacion' => 0,
                            'objetivo_id' => $objetivo->id,
                            'evaluado_id' => $eva->empleado_id,
                            'evaluador_id' => $evldr->evaluador_id,
                            'evaluacion_id' => $ev->id,
                        ]);
                    }
                }
            }
        }

        return response()->json(['success' => true]);
    }

    public function editByEmpleado(Request $request, $empleado, $objetivo)
    {
        $objetivo = Objetivo::find(intval($objetivo))->load(['tipo', 'metrica']);
        $empleado = Empleado::getAll()->find(intval($empleado));
        $empleado->load(['objetivos' => function ($q) {
            $q->with(['objetivo' => function ($query) {
                $query->with(['tipo', 'metrica']);
            }]);
        }]);

        return $objetivo;
    }


    public function destroyByEmpleado($id)
    {
        $objetivo = Objetivo::findOrFail($id); // Buscar el objetivo por ID
        $objetivo_empleado = ObjetivoEmpleado::where('objetivo_id',$id)->first();

        $ev = $this->evaluacionActiva();

        if (isset($ev->id)) {
            ObjetivoRespuesta::where('objetivo_id', $objetivo->id)
                ->where('evaluado_id', $objetivo_empleado->empleado_id)
                ->where('evaluacion_id', '=', $ev->id)
                ->delete();
        }

        $objetivo->delete(); // Eliminar el registro de ObjetivoEmpleado
        $objetivo_empleado->delete(); // Eliminar el registro de ObjetivoEmpleado

        return response()->json(['success' => '¡Eliminado con éxito!']);
    }


    public function evaluacionActiva()
    {
        $evaluacion = Evaluacion::select('id')->where('estatus', 2)
            ->where('include_objetivos', true)
            ->latest() // Order by created_at in descending order
            ->first(); // Retrieve the first result

        return $evaluacion;
    }

    public function edit($objetivo)
    {
        $objetivo = Objetivo::find($objetivo);
        $tipo_seleccionado = $objetivo->tipo_id;
        $metrica_seleccionada = $objetivo->metrica_id;

        return view('admin.recursos-humanos.evaluacion-360.objetivos.edit', compact('objetivo', 'tipo_seleccionado', 'metrica_seleccionada'));
    }

    public function updateByEmpleado(Request $request, $objetivo)
    {
        abort_if(Gate::denies('objetivos_estrategicos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'KPI' => 'required|string|max:1500',
            'meta' => 'required|integer|min:0',
            'descripcion_meta' => 'nullable|string|max:1500',
            'tipo_id' => 'required|exists:ev360_tipo_objetivos,id',
            'metrica_id' => 'required|exists:ev360_metricas_objetivos,id',
        ]);

        // dd($request->all());

        $objetivo = Objetivo::find($objetivo);
        $u_objetivo = $objetivo->update([
            'nombre' => $request->nombre,
            'KPI' => $request->KPI,
            'meta' => $request->meta,
            'descripcion_meta' => $request->descripcion_meta,
            'tipo_id' => $request->tipo_id,
            'metrica_id' => $request->metrica_id,
            'esta_aprobado' => Objetivo::SIN_DEFINIR,
        ]);
        if ($request->hasFile('foto')) {
            Storage::makeDirectory('public/objetivos/img'); //Crear si no existe
            $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
            $nombre_imagen = 'OBJETIVO_'.$objetivo->id.'_'.$objetivo->nombre.'EMPLEADO_'.$objetivo->empleado_id.'.'.$extension;
            $route = storage_path().'/app/public/objetivos/img/'.$nombre_imagen;

            // Call the ImageService to consume the external API
            $apiResponse = ImageService::consumeImageCompresorApi($request->file('foto'));

            // Compress and save the image
            if ($apiResponse['status'] == 200) {
                file_put_contents($route, $apiResponse['body']);
            }

            $objetivo->update([
                'imagen' => $nombre_imagen,
            ]);
        }
        if ($u_objetivo) {
            return ['success', 'Objetivo editado con éxito'];
        } else {
            return ['error', 'Ocurrió un error al editar el objetivo, intente de nuevo...'];
        }
    }

    public function show(Request $request, $empleado)
    {
        try {
            abort_if(Gate::denies('objetivos_estrategicos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $objetivo = new Objetivo;
            $empleado = Empleado::getAll()->find(intval($empleado));
            if (! $empleado) {
                abort(404);
            }
            $empleado->load(['objetivos' => function ($q) {
                $q->with(['objetivo' => function ($query) {
                    $query->with(['tipo', 'metrica']);
                }]);
            }]);
            $objetivos = $empleado->objetivos ? $empleado->objetivos : collect();
            if ($request->ajax()) {
                return datatables()->of($objetivos)->toJson();
            }

            return view('admin.recursos-humanos.evaluacion-360.objetivos.show', compact('empleado'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function indexCopiar($empleado)
    {
        abort_if(Gate::denies('objetivos_estrategicos_copiar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado = Empleado::select('id', 'name', 'foto', 'genero')->with(['objetivos' => function ($query) {
            return $query->with('objetivo');
        }])->find(intval($empleado));
        $objetivos_empleado = $empleado->objetivos;
        if (count($objetivos_empleado)) {
            $empleados = Empleado::getaltaAllWithAreaObjetivoPerfil()->except($empleado->id);

            return response()->json([
                'empleados' => $empleados,
                'hasObjetivos' => true,
                'objetivos' => $objetivos_empleado,
            ]);
        } else {
            return response()->json(['hasObjetivos' => false]);
        }
    }

    public function storeCopiaObjetivos(Request $request)
    {
        abort_if(Gate::denies('objetivos_estrategicos_copiar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'empleado_destinatario' => 'required',
            'empleado_destino' => 'required',
        ]);

        $empleado = Empleado::select('id', 'name')->with('objetivos')->find(intval($request->empleado_destinatario));
        $objetivos_empleado = $empleado->objetivos;
        foreach ($objetivos_empleado as $objetivo) {
            ObjetivoEmpleado::create([
                'objetivo_id' => $objetivo->objetivo_id,
                'empleado_id' => $request->empleado_destino,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function definirNuevosObjetivos()
    {
        $objetivosAnteriores = ObjetivoEmpleado::where('en_curso', true)->get();
        foreach ($objetivosAnteriores as $objetivoAnterior) {
            $objetivoAnterior->update([
                'en_curso' => false,
            ]);
        }

        return response()->json(['estatus' => 200]);
    }
}
