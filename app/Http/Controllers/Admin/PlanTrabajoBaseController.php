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
    public function index()
    {

        $gantt_path = 'storage/gantt/';

        $path = public_path($gantt_path);


        $json_code = json_decode(file_get_contents($path.'/gantt_inicial.json'), true);
        $json_code['resources'] = Empleado::select('id', 'name', 'foto', 'genero')->get()->toArray();
        $write_empleados = $json_code;
        file_put_contents($path.'/gantt_inicial.json', json_encode($write_empleados));


        $files = glob("storage/gantt/versiones/gantt_inicial*.json");
        $archivos_gantt = [];

        sort($files, SORT_NATURAL | SORT_FLAG_CASE);
        foreach ($files as $clave => $valor) {
            array_push($archivos_gantt, $valor);
        }

        $path_asset = asset('storage/gantt/versiones/');
        $gant_readed = end($archivos_gantt);

        

        $file_gant = json_decode(file_get_contents($gant_readed), true);



        $empleados = Empleado::select("name")->get();


        // $name_file_gantt = basename($gant_readed);
        $name_file_gantt = 'gantt_inicial.json';


        return view('admin.planTrabajoBase.index', compact('archivos_gantt', 'path_asset', 'gant_readed', 'empleados', 'file_gant', 'name_file_gantt'));
    }

    public function saveImplementationProyect(Request $request)
    {

        $gantt_path = 'storage/gantt/versiones/';

        $path = public_path($gantt_path);

        $version_gantt = glob($path . "gantt_inicial*.json");

        $ultima_version = 0;

        if (count($version_gantt)) {
            $ultima_version = count($version_gantt);
        }

        if ($request->ajax()) {

            $proyecto = $request->get('txt_prj');

            $file = Storage::disk('public')->put('gantt/versiones/gantt_inicial_v' . $ultima_version . '.json', $proyecto);
            $file = Storage::disk('public')->put('gantt/gantt_inicial.json', $proyecto);

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

        $files = glob($path . "gantt_inicial*.json");
        $version_gantt = [];

        sort($files, SORT_NATURAL | SORT_FLAG_CASE);
        foreach ($files as $clave => $valor) {
            array_push($version_gantt, $valor);
        }


        // $path = end($version_gantt);
        $path_g = $path . 'gantt_inicial.json';
        $json_code =  json_decode(file_get_contents($path_g), true);

        return $json_code;
    }



    public function saveCurrentProyect(Request $request)
    {
        if ($request->ajax()) {

            $gantt_path = 'storage/gantt/gantt_inicial.json';

            $path = public_path($gantt_path);


            $store = file_put_contents($path, $request->gantt);

            return response('guardado con exito', 200);
        }
    }

    public function saveStatus(Request $request)
    {
        if ($request->ajax()) {

            $status_path = 'storage/gantt/status.json';

            $path = public_path($status_path);
            file_put_contents($path, $request->estatuses);

            return response('guardado con exito', 200);
        }
    }

    public function checkChanges(Request $request)
    {
        if ($request->ajax()) {

            $proyecto = $request->txt_prj;

            Storage::disk('public')->put('gantt/tmp/ganttTemporal.json', $proyecto);

            $gantt_path = 'storage/gantt/';
            $path = public_path($gantt_path);
            $files = glob($path . "gantt_inicial*.json");
            $archivos_gantt = [];

            sort($files, SORT_NATURAL | SORT_FLAG_CASE);
            foreach ($files as $valor) {
                array_push($archivos_gantt, $valor);
            }

            $current_gantt = $path . "gantt_inicial.json";
            $tmp_gantt = json_decode(file_get_contents($path . 'tmp/ganttTemporal.json'));
            $old_gant = json_decode(file_get_contents($current_gantt));
            $notExistsChanges = $tmp_gantt == $old_gant;

            if (!$notExistsChanges) {
                return response()->json(['existsChanges' => true]);
            } else {
                return response()->json(['notExistsChanges' => true]);
            }
        }
    }
}
