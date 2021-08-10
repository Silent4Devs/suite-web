<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Functions\Porcentaje;
use App\Models\ActividadFase;
use Illuminate\Http\Response;
use App\Models\PlanImplementacion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\PlanImplementacionTask;
use Illuminate\Support\Facades\Storage;

class PlanTrabajoBaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('implementacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $gantt_path = 'storage/gantt/';
        $path = public_path($gantt_path);
        $json_code = json_decode(file_get_contents($path . '/gantt_inicial.json'), true);
        $json_code['resources'] = Empleado::select('id', 'name', 'foto', 'genero')->get()->toArray();
        $write_empleados = $json_code;
        file_put_contents($path . '/gantt_inicial.json', json_encode($write_empleados));


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
        $name_file_gantt = 'gantt_inicial.json';


        return view('admin.planTrabajoBase.index', compact('archivos_gantt', 'path_asset', 'gant_readed', 'empleados', 'file_gant', 'name_file_gantt'));
    }



    public function saveImplementationProyect(Request $request)
    {
        /*$project =  $request->prj;
        if (PlanImplementacion::find(1)) {
            PlanImplementacion::find(1)->update([
                'canAdd' => isset($project['canAdd']) ? $project['canAdd'] : true,
                'canWrite' => isset($project['canWrite']) ? $project['canWrite'] : true,
                'canWriteOnParent' => isset($project['canWriteOnParent']) ? $project['canWriteOnParent'] : null,
                'changesReasonWhy' => isset($project['changesReasonWhy']) ? $project['changesReasonWhy'] : null,
                'selectedRow' => isset($project['selectedRow']) ? $project['selectedRow'] : 0,
                'zoom' => isset($project['zoom']) ? $project['zoom'] : '1M',
            ]);
        } else {
            PlanImplementacion::create([
                'canAdd' => isset($project['canAdd']) ? $project['canAdd'] : true,
                'canWrite' => isset($project['canWrite']) ? $project['canWrite'] : true,
                'canWriteOnParent' => isset($project['canWriteOnParent']) ? $project['canWriteOnParent'] : null,
                'changesReasonWhy' => isset($project['changesReasonWhy']) ? $project['changesReasonWhy'] : null,
                'selectedRow' => isset($project['selectedRow']) ? $project['selectedRow'] : 0,
                'zoom' => isset($project['zoom']) ? $project['zoom'] : '1M',
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement('TRUNCATE empleado_task');
        PlanImplementacionTask::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        $tasks = isset($project['tasks']) ? $project['tasks'] : null;
        if ($tasks) {
            foreach ($tasks as $task) {
                $assigs = isset($task['assigs']) ? $task['assigs'] : [];
                $assigs_arr = array();
                foreach ($assigs as $assig) {
                    array_push($assigs_arr, intval($assig['resourceId']));
                }
                // dd($assigs_arr);
                $level_formateado = isset($task['level']) ? $task['level'] : 0;
                $task_id = $task['id'] == '-1' ? '1' : $task['id'];
                if (PlanImplementacionTask::where('id_task', $task_id)->first()) {
                    $task_actual = PlanImplementacionTask::where('id_task', $task_id)->first();
                    $task_actual->update([
                        'name' => isset($task['name']) ? $task['name'] : null,
                        'progress' => isset($task['progress']) ? $task['progress'] : null,
                        'progressByWorklog' => isset($task['progressByWorklog']) ? $task['progressByWorklog'] : null,
                        'description' => isset($task['description']) ? $task['description'] : null,
                        'level' => $level_formateado,
                        'status' => isset($task['status']) ? $task['status'] : 'STATUS_UNDEFINED',
                        'depends' => isset($task['depends']) ? $task['depends'] : null,
                        'start' => isset($task['start']) ? $task['start'] : null,
                        'duration' => isset($task['duration']) ? $task['duration'] : null,
                        'end' => isset($task['end']) ? $task['end'] : null,
                        'startIsMilestone' => isset($task['startIsMilestone']) ? $task['startIsMilestone'] : null,
                        'endIsMilestone' => isset($task['endIsMilestone']) ? $task['endIsMilestone'] : null,
                        'collapsed' => isset($task['collapsed']) ? $task['collapsed'] : null,
                        'canWrite' => isset($task['canWrite']) ? $task['canWrite'] : null,
                        'canAdd' => isset($task['canAdd']) ? $task['canAdd'] : null,
                        'canDelete' => isset($task['canDelete']) ? $task['canDelete'] : null,
                        'canAddIssue' => isset($task['canAddIssue']) ? $task['canAddIssue'] : null,
                        'id_fase' => isset($task['id_fase']) ? $task['id_fase'] : null,
                        'id_task' => isset($task_id) ? $task_id : null,
                        'url' => isset($task['url']) ? $task['url'] : null,
                        'plan_implementacion_id' => 1,
                    ]);
                    $task_actual->assigs()->attach($assigs_arr);
                } else {
                    $task_creada = PlanImplementacionTask::create([
                        'name' => isset($task['name']) ? $task['name'] : null,
                        'progress' => isset($task['progress']) ? $task['progress'] : null,
                        'progressByWorklog' => isset($task['progressByWorklog']) ? $task['progressByWorklog'] : null,
                        'description' => isset($task['description']) ? $task['description'] : null,
                        'level' => $level_formateado,
                        'status' => isset($task['status']) ? $task['status'] : 'STATUS_UNDEFINED',
                        'depends' => isset($task['depends']) ? $task['depends'] : "",
                        'start' => isset($task['start']) ? $task['start'] : null,
                        'duration' => isset($task['duration']) ? $task['duration'] : null,
                        'end' => isset($task['end']) ? $task['end'] : null,
                        'startIsMilestone' => isset($task['startIsMilestone']) ? $task['startIsMilestone'] : null,
                        'endIsMilestone' => isset($task['endIsMilestone']) ? $task['endIsMilestone'] : null,
                        'collapsed' => isset($task['collapsed']) ? $task['collapsed'] : null,
                        'canWrite' => isset($task['canWrite']) ? $task['canWrite'] : null,
                        'canAdd' => isset($task['canAdd']) ? $task['canAdd'] : null,
                        'canDelete' => isset($task['canDelete']) ? $task['canDelete'] : null,
                        'canAddIssue' => isset($task['canAddIssue']) ? $task['canAddIssue'] : null,
                        'id_fase' => isset($task['id_fase']) ? $task['id_fase'] : null,
                        'id_task' => isset($task_id) ? $task_id : null,
                        'url' => isset($task['url']) ? $task['url'] : null,
                        'plan_implementacion_id' => 1,
                    ]);
                    $task_creada->assigs()->attach($assigs_arr);
                }
            }
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            PlanImplementacionTask::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        }*/

        $project =  $request->prj;

        // if (isset($project['tasks'])) {
        //     foreach ($project['tasks'] as $task) {
        //         if (!isset($task['assigs'])) {
        //             $project = array_merge((array)$project, array('assigs' => []));
        //         }
        //     }
        // }
        // dd($project['tasks']);
        if (PlanImplementacion::find(1)) {
            $tasks = isset($project['tasks']) ? $project['tasks'] : [];
            PlanImplementacion::find(1)->update([
                'tasks' => $tasks,
                'canAdd' => isset($project['canAdd']) ? $project['canAdd'] : true,
                'canWrite' => isset($project['canWrite']) ? $project['canWrite'] : true,
                'canWriteOnParent' => isset($project['canWriteOnParent']) ? $project['canWriteOnParent'] : null,
                'changesReasonWhy' => isset($project['changesReasonWhy']) ? $project['changesReasonWhy'] : null,
                'selectedRow' => isset($project['selectedRow']) ? $project['selectedRow'] : 0,
                'zoom' => isset($project['zoom']) ? $project['zoom'] : '1M',
            ]);
        } else {
            $tasks = isset($project['tasks']) ? $project['tasks'] : [];
            PlanImplementacion::create([
                'tasks' => $tasks,
                'canAdd' => isset($project['canAdd']) ? $project['canAdd'] : true,
                'canWrite' => isset($project['canWrite']) ? $project['canWrite'] : true,
                'canWriteOnParent' => isset($project['canWriteOnParent']) ? $project['canWriteOnParent'] : null,
                'changesReasonWhy' => isset($project['changesReasonWhy']) ? $project['changesReasonWhy'] : null,
                'selectedRow' => isset($project['selectedRow']) ? $project['selectedRow'] : 0,
                'zoom' => isset($project['zoom']) ? $project['zoom'] : '1M',
            ]);
        }
        return response()->json(['success' => true], 200);

        // $gantt_path = 'storage/gantt/versiones/';
        // $path = public_path($gantt_path);
        // $version_gantt = glob($path . "gantt_inicial*.json");
        // $ultima_version = 0;

        // if (count($version_gantt)) {
        //     $ultima_version = count($version_gantt);
        // }

        // if ($request->ajax()) {
        //     $proyecto = $request->get('txt_prj');
        //     $file = Storage::disk('public')->put('gantt/versiones/gantt_inicial_v' . $ultima_version . '.json', $proyecto);
        //     $file = Storage::disk('public')->put('gantt/gantt_inicial.json', $proyecto);

        //     if ($file) {
        //         return response()->json(['success' => true], 200);
        //     } else {
        //         return response()->json(['error' => true], 401);
        //     }
        // }
    }



    public function loadProyect()
    {
        $implementacion = PlanImplementacion::first();
        $tasks = $implementacion->tasks;
        foreach ($tasks as $task) {
            $task->end = intval($task->end);
            $task->start = intval($task->start);
            $task->canAdd = $task->canAdd == 'true' ? true : false;
            $task->canWrite = $task->canWrite == 'true' ? true : false;
            $task->duration = intval($task->duration);
            $task->progress = intval($task->progress);
            $task->canDelete = $task->canDelete == 'true' ? true : false;
            isset($task->level) ? $task->level = intval($task->level) : $task->level = 0;
            isset($task->collapsed) ? $task->collapsed = $task->collapsed == 'true' ? true : false : $task->collapsed = false;
            $task->canAddIssue = $task->canAddIssue == 'true' ? true : false;
            $task->endIsMilestone = $task->endIsMilestone == 'true' ? true : false;
            $task->startIsMilestone = $task->startIsMilestone == 'true' ? true : false;
            $task->progressByWorklog = $task->progressByWorklog == 'true' ? true : false;
        }
        $implementacion->tasks = $tasks;

        return $implementacion;
        // $gantt_path = 'storage/gantt/';
        // $path = public_path($gantt_path);
        // $files = glob($path . "gantt_inicial*.json");
        // $version_gantt = [];
        // sort($files, SORT_NATURAL | SORT_FLAG_CASE);
        // foreach ($files as $clave => $valor) {
        //     array_push($version_gantt, $valor);
        // }

        // $path_g = $path . 'gantt_inicial.json';
        // $json_code =  json_decode(file_get_contents($path_g), true);

        // return $json_code;
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
