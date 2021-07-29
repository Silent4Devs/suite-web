<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PlanBaseActividade;
use App\Models\AuditoriaAnual;
use App\Models\Recurso;
use App\Models\IncidentesSeguridad;
use App\Models\RiesgoIdentificado;
use App\Models\Activo;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;


class inicioUsuarioController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();
        $empleado_id = $usuario->empleado ? $usuario->empleado->id : 0;
        $gantt_path = 'storage/gantt/gantt_inicial.json';
        $actividades = [];
        if (file_exists($gantt_path)) {
            $file_gantt = json_decode(file_get_contents($gantt_path), true);
            $actividades = array_filter($file_gantt['tasks'], function ($tarea) use ($empleado_id) {
                $assigs = $tarea['assigs'];
                foreach ($assigs as $assig) {
                    if ($assig['resourceId'] == $empleado_id) {
                        return $tarea;
                    }
                }
            });
        }
        $auditorias_anual = AuditoriaAnual::all();
        $recursos = Recurso::whereHas('empleados', function ($query) use ($usuario) {
            $query->where('empleados.id', $usuario->id);
        })->get();

        $documentos_publicados = Documento::where('estatus', Documento::PUBLICADO)->latest('updated_at')->get()->take(5);
        return view('admin.inicioUsuario.index', compact('usuario', 'recursos', 'actividades', 'documentos_publicados', 'auditorias_anual'));
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function show()
    {
    }

    public function destroy()
    {
    }



    public function optenerTareas($tarea)
    {
        $assigs = $tarea['assigs'];
        foreach ($assigs as $assig) {
            if ($assig == auth()->user()) {
                return $tarea;
            }
        }
    }


    public function quejas()
    {
        return view('admin.inicioUsuario.formularios.quejas');
    }

    public function denuncias()
    {
        return view('admin.inicioUsuario.formularios.denuncias');
    }

    public function mejoras()
    {
        return view('admin.inicioUsuario.formularios.mejoras');
    }

    public function sugerencias()
    {
        return view('admin.inicioUsuario.formularios.sugerencias');
    }



    public function seguridad()
    {

        $activos = Activo::get();

        return view('admin.inicioUsuario.formularios.seguridad', compact('activos'));
    }
    public function storeSeguridad(Request $request)
    {


        // $request->validate([
        //     'fecha'=>'required|date',
        //     'titulo'=>'required|string',
        //     'descripcion'=>'required|string',
        //     'activos_afectados'=>'required|string',
        // ]);

        $incidentes_seguridad = IncidentesSeguridad::create([
            'fecha' => $request->fecha,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => auth()->user()->empleado->id,
        ]);

        $archivos = explode(',', $request->input('archivo'));

        foreach ($archivos as $archivo) {
            if ($request->input('archivo', false)) {
                $incidentes_seguridad->addMedia(storage_path('tmp/uploads/' . $archivo))->toMediaCollection('archivo');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $incidentes_seguridad->id]);
            }
        }



        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function evidenciaSeguridad()
    {
    }



    public function riesgos()
    {

        return view('admin.inicioUsuario.formularios.riesgos');
    }
    public function storeRiesgos(Request $request)
    {

        RiesgoIdentificado::create([
            'fecha' => $request->fecha,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'activos_afectados' => $request->activos_afectados,
            'proceso' => $request->proceso,
            'empleado_reporto_id' => auth()->user()->empleado->id,
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }
}
