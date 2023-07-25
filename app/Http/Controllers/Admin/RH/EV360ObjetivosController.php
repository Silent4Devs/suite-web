<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Mail\SolicitudAprobacionObjetivo;
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
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EV360ObjetivosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('objetivos_estrategicos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $empleados = Empleado::alta()->with(['objetivos', 'area', 'perfil'])->get();
            $isAdmin = in_array('Admin', auth()->user()->roles->pluck('title')->toArray());
            if (auth()->user()->empleado->children->count() > 0 && !$isAdmin) {
                return datatables()->of(auth()->user()->empleado->children)->toJson();
            } elseif ($isAdmin) {
                return datatables()->of($empleados)->toJson();
            } else {
                return datatables()->of($empleados)->toJson();
            }
        }

        $areas = Area::getAll();
        $puestos = Puesto::select('id', 'puesto')->get();
        $perfiles = PerfilEmpleado::select('id', 'nombre')->get();

        return view('admin.recursos-humanos.evaluacion-360.objetivos.index', compact('areas', 'puestos', 'perfiles'));
    }

    public function create()
    {
        abort_if(Gate::denies('objetivos_estrategicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.recursos-humanos.evaluacion-360.objetivos.objetivos-negocio');
    }

    public function createByEmpleado(Request $request, $empleado)
    {
        abort_if(Gate::denies('objetivos_estrategicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $objetivo = new Objetivo;
        $empleado = Empleado::find(intval($empleado));
        $empleado->load(['objetivos' => function ($q) {
            $q->with(['objetivo' => function ($query) {
                $query->with(['tipo', 'metrica']);
            }]);
        }]);
        if ($request->ajax()) {
            $objetivos = $empleado->objetivos ? $empleado->objetivos : collect();

            return datatables()->of($objetivos)->toJson();
        }
        $tipo_seleccionado = null;
        $metrica_seleccionada = null;
        if ($request->ajax()) {
        }

        $empleados = Empleado::getaltaAll();

        return view('admin.recursos-humanos.evaluacion-360.objetivos.create-by-empleado', compact('objetivo', 'tipo_seleccionado', 'metrica_seleccionada', 'empleado', 'empleados'));
    }

    public function storeByEmpleado(Request $request, $empleado)
    {
        abort_if(Gate::denies('objetivos_estrategicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'KPI' => 'required|string|max:1500',
            'meta' => 'required|integer|min:1',
            'descripcion_meta' => 'nullable|string|max:1500',
            'tipo_id' => 'required|exists:ev360_tipo_objetivos,id',
            'metrica_id' => 'required|exists:ev360_metricas_objetivos,id',
        ]);
        $empleado = Empleado::with('supervisor')->find(intval($empleado));

        if ($request->ajax()) {
            if ($empleado->id == auth()->user()->empleado->id) {
                //add esta_aprobado in $request
                $request->merge(['esta_aprobado' => Objetivo::SIN_DEFINIR]);
            }
            $objetivo = Objetivo::create($request->all());

            //send email if who add is not supervisor
            // if ($empleado->id == auth()->user()->empleado->id) {
            //     if (!is_null($empleado->supervisor)) {
            //         Mail::to($empleado->email)->send(new SolicitudAprobacionObjetivo($objetivo, $empleado));
            //     }
            // }
            if ($request->hasFile('foto')) {
                Storage::makeDirectory('public/objetivos/img'); //Crear si no existe
                $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
                $nombre_imagen = 'OBJETIVO_' . $objetivo->id . '_' . $objetivo->nombre . 'EMPLEADO_' . $empleado->id . '.' . $extension;
                $route = storage_path() . '/app/public/objetivos/img/' . $nombre_imagen;
                //Usamos image_intervention para disminuir el peso de la imagen
                $img_intervention = Image::make($request->file('foto'));
                $img_intervention->resize(720, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($route);
                $objetivo->update([
                    'imagen' => $nombre_imagen,
                ]);
            }
            ObjetivoEmpleado::create([
                'objetivo_id' => $objetivo->id,
                'empleado_id' => $empleado->id,
            ]);

            $reciente = Evaluacion::latest()->first();

            $evaluacion = EvaluacionesEvaluados::where('evaluacion_id', '=', $reciente->id)->get();

            foreach ($evaluacion as $evalu) {
                $evaluado = ObjetivoEmpleado::where('objetivo_id', '=', $objetivo->id)
                    ->where('empleado_id', '=', $evalu->evaluado_id)
                    ->where('en_curso', '=', true)->get();

                foreach ($evaluado as $eva) {
                    $evaluador = EvaluadoEvaluador::where('evaluado_id', '=', $evalu->evaluado_id)
                        ->where('evaluacion_id', '=', $reciente->id)
                        ->whereIn('tipo', ['0', '1'])->get();

                    foreach ($evaluador as $evldr) {
                        ObjetivoRespuesta::create([
                            'meta_alcanzada' => 'Sin evaluar',
                            'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
                            'calificacion' => 0,
                            'objetivo_id' => $objetivo->id,
                            'evaluado_id' => $eva->empleado_id,
                            'evaluador_id' => $evldr->evaluador_id,
                            'evaluacion_id' => $reciente->id,
                        ]);
                        ObjetivoEmpleado::where('objetivo_id', '=', $objetivo->id)
                            ->where('en_curso', '=', true)
                            ->where('empleado_id', '=', $eva->empleado_id)
                            ->update([
                                'evaluacion_id' => $reciente->id,
                            ]);
                    }
                }
            }

            if ($objetivo) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
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
            return redirect()->route('admin.ev360-objetivos.index')->with('success', 'Objetivo creado con éxito');
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
        $reciente = Evaluacion::latest()->first();

        if ($objetivo->esta_aprobado == '1') {
            $evaluacion = EvaluacionesEvaluados::where('evaluacion_id', '=', $reciente->id)->get();

            foreach ($evaluacion as $evalu) {
                $evaluado = ObjetivoEmpleado::where('objetivo_id', '=', $objetivo->id)
                    ->where('empleado_id', '=', $evalu->evaluado_id)
                    ->where('en_curso', '=', true)->get();

                foreach ($evaluado as $eva) {
                    $evaluador = EvaluadoEvaluador::where('evaluado_id', '=', $evalu->evaluado_id)
                        ->where('evaluacion_id', '=', $reciente->id)
                        ->whereIn('tipo', ['0', '1'])->get();

                    foreach ($evaluador as $evldr) {
                        ObjetivoRespuesta::create([
                            'meta_alcanzada' => 'Sin evaluar',
                            'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
                            'calificacion' => 0,
                            'objetivo_id' => $objetivo->id,
                            'evaluado_id' => $eva->empleado_id,
                            'evaluador_id' => $evldr->evaluador_id,
                            'evaluacion_id' => $reciente->id,
                        ]);
                        ObjetivoEmpleado::where('objetivo_id', '=', $objetivo->id)
                            ->where('en_curso', '=', true)
                            ->where('empleado_id', '=', $eva->empleado_id)
                            ->update([
                                'evaluacion_id' => $reciente->id,
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
        $empleado = Empleado::find(intval($empleado));
        $empleado->load(['objetivos' => function ($q) {
            $q->with(['objetivo' => function ($query) {
                $query->with(['tipo', 'metrica']);
            }]);
        }]);

        return $objetivo;
    }

    public function destroyByEmpleado(Request $request, ObjetivoEmpleado $objetivo)
    {
        //Buscar en objetivo calificaciones y se borra
        $objres = ObjetivoRespuesta::where('objetivo_id', $objetivo->objetivo_id)
            ->where('evaluado_id', $objetivo->empleado_id)
            ->where('evaluacion_id', $objetivo->evaluacion_id);

        //Borrar si existe
        if ($objres != null) {
            $objres->delete();
        }

        // $objetivo = ObjetivoEmpleado::find($request->all());
        $objetivo->delete(); //Se borra de objetivo empleado

        return response()->json(['success' => 'deleted successfully!', $request->all()]);
        // $objetivo->delete();
        // return response()->json(['success'=> 'Eliminado exitosamente']);
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
            'meta' => 'required|integer',
            'descripcion_meta' => 'nullable|string|max:1500',
            'tipo_id' => 'required|exists:ev360_tipo_objetivos,id',
            'metrica_id' => 'required|exists:ev360_metricas_objetivos,id',
        ]);

        $objetivo = Objetivo::find($objetivo);
        $u_objetivo = $objetivo->update([
            'nombre' => $request->nombre,
            'KPI' => $request->KPI,
            'meta' => $request->meta,
            'descripcion_meta' => $request->descripcion,
            'tipo_id' => $request->tipo_id,
            'metrica_id' => $request->metrica_id,
        ]);
        if ($request->hasFile('foto')) {
            Storage::makeDirectory('public/objetivos/img'); //Crear si no existe
            $extension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_EXTENSION);
            $nombre_imagen = 'OBJETIVO_' . $objetivo->id . '_' . $objetivo->nombre . 'EMPLEADO_' . $objetivo->empleado_id . '.' . $extension;
            $route = storage_path() . '/app/public/objetivos/img/' . $nombre_imagen;
            //Usamos image_intervention para disminuir el peso de la imagen
            $img_intervention = Image::make($request->file('foto'));
            $img_intervention->resize(720, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($route);
            $objetivo->update([
                'imagen' => $nombre_imagen,
            ]);
        }
        if ($u_objetivo) {
            return redirect()->route('admin.ev360-objetivos.index')->with('success', 'Objetivo editado con éxito');
        } else {
            return redirect()->route('admin.ev360-objetivos.index')->with('error', 'Ocurrió un error al editar el objetivo, intente de nuevo...');
        }
    }

    public function show(Request $request, $empleado)
    {
        abort_if(Gate::denies('objetivos_estrategicos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $objetivo = new Objetivo;
        $empleado = Empleado::find(intval($empleado));
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
    }

    public function indexCopiar($empleado)
    {
        abort_if(Gate::denies('objetivos_estrategicos_copiar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado = Empleado::select('id', 'name', 'foto', 'genero')->with(['objetivos' => function ($query) {
            return $query->with('objetivo');
        }])->find(intval($empleado));
        $objetivos_empleado = $empleado->objetivos;
        if (count($objetivos_empleado)) {
            $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get()->except($empleado->id);

            return response()->json(['empleados' => $empleados, 'hasObjetivos' => true, 'objetivos' => $objetivos_empleado]);
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

    public function destroy(ObjetivoEmpleado $objetivoEmpleado)
    {
        $objetivoEmpleado->delete();

        return response()->json(['deleted' => true]);
    }
}
