<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Functions\Porcentaje;
use App\Models\User;
use App\Models\ActividadFase;
use App\Models\Empleado;
use Illuminate\Support\Facades\Storage;

class PlanTrabajoBaseController extends Controller
{
    public function index(){
        $gantt_path = 'storage/gantt/';
        $path = public_path($gantt_path);
        $archivos_gantt = glob($path . "gantt_inicial*.json");
        // PlanBaseActividade::with('fase')->get()
        $path_asset = asset($gantt_path);
        $gant_readed = end($archivos_gantt);
        //dd($planbase, $responsable, $responsablenom);

        $empleados = Empleado::select("name")->get();

        return view('admin.planTrabajoBase.index', compact('archivos_gantt', 'path_asset', 'gant_readed', 'empleados'));
    }

     public function saveImplementationProyect(Request $request)
    {

        $gantt_path = 'storage/gantt/';

        $path = public_path($gantt_path);

        $version_gantt = glob($path . "gantt_inicial*.json");

        $ultima_version = 0;

        if (count($version_gantt)) {
            $ultima_version = count($version_gantt);
        }

        if ($request->ajax()) {

            $proyecto = $request->get('txt_prj');

            // dd($proyecto);

            // $json = json_encode($proyecto);


            // $file = file_put_contents(storage_path('app/public/gantt/gantt_inicial.json'), $json);

            $file = Storage::disk('public')->put('gantt/gantt_inicial_v' . $ultima_version . '.json', $proyecto);

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

        $version_gantt = glob($path . "gantt_inicial*.json");

        $path = end($version_gantt);
        $json_code =  json_decode(file_get_contents($path), true);

        return $json_code;
    }
}
