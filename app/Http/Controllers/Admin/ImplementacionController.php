<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActividadFase;
use App\Models\PlanBaseActividade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImplementacionController extends Controller
{
    public function index()
    {
        // dd(ActividadFase::with('plan_base_actividades')->get());

        $users = User::getAll();

        $fases = ActividadFase::with('plan_base_actividades')->get();
        $gantt_path = 'storage/gantt/';
        $path = public_path($gantt_path);
        $archivos_gantt = glob($path.'gantt_inicial*.json');
        // PlanBaseActividade::with('fase')->get()
        $path_asset = asset($gantt_path);
        $gant_readed = end($archivos_gantt);
        $planbase = PlanBaseActividade::getWithActividad();
        $responsable = $users;
        $responsablenom = $users->where('id', '=', '3');

        //dd($planbase, $responsable, $responsablenom);
        return view('admin.implementacions.index', compact('planbase', 'responsable', 'fases', 'archivos_gantt', 'path_asset', 'gant_readed'))
            ->with('planbases', $planbase);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            switch ($request->name) {
                case 'estatus_id':
                    $planbas = PlanBaseActividade::findOrFail($id);
                    $planbas->estatus_id = $request->value;
                    $planbas->save();

                    return response()->json(['success' => $request]);
                    break;
                case 'fecha_inicio_p':
                    $planbas = PlanBaseActividade::findOrFail($id);
                    $planbas->fecha_inicio = $request->value;
                    $planbas->save();

                    return response()->json(['success' => $request]);
                    break;
            }
        }
    }

    public function saveImplementationProyect(Request $request)
    {
        $gantt_path = 'storage/gantt/';

        $path = public_path($gantt_path);

        $version_gantt = glob($path.'gantt_inicial*.json');

        $ultima_version = 0;

        if (count($version_gantt)) {
            $ultima_version = count($version_gantt);
        }

        if ($request->ajax()) {
            $proyecto = $request->get('txt_prj');

            // dd($proyecto);

            // $json = json_encode($proyecto);

            // $file = file_put_contents(storage_path('app/public/gantt/gantt_inicial.json'), $json);

            $file = Storage::disk('public')->put('gantt/gantt_inicial_v'.$ultima_version.'.json', $proyecto);

            if ($file) {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['error' => true], 401);
            }
        }
    }

    public function loadProyect(Request $request)
    {
        $gantt_path = 'storage/gantt/';

        $path = public_path($gantt_path);

        $version_gantt = glob($path.'gantt_inicial*.json');

        $path = end($version_gantt);
        $json_code = json_decode(file_get_contents($path), true);

        return $json_code;
    }
}
