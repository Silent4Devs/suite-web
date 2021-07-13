<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PlanBaseActividade;
use App\Models\AuditoriaAnual;
use App\Models\Recurso;


class inicioUsuarioController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();
        $empleado_id = $usuario->empleado->id;

        $gantt_path = 'storage/gantt/';

        $version_gantt = glob($gantt_path . "gantt_inicial*.json");

        $path_gantt = end($version_gantt);

        $file_gantt = json_decode(file_get_contents($path_gantt), true);

        // $actividades = collect($file_gantt->tasks)->filter(function($actividad){
        //     return count($actividad->assigs) == 0;
        // });



        $actividades = array_filter($file_gantt['tasks'], function($tarea)use($empleado_id){
             $assigs = $tarea['assigs'];
            foreach($assigs as $assig){
                if ($assig['resourceId'] == $empleado_id) {
                    return $tarea;
                }
            } 
        }); 

        


        $plan_base = PlanBaseActividade::get();

        $auditorias_anual = AuditoriaAnual::get();

        $recursos = Recurso::whereHas('empleados', function($query)use($usuario){
            $query->where('empleados.id',$usuario->id);
        })->get();

        
        

        return view('admin.inicioUsuario.index', compact('usuario', 'file_gantt', 'plan_base', 'auditorias_anual', 'recursos', 'actividades'));
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



    public function optenerTareas($tarea){
        $assigs = $tarea['assigs'];
        foreach($assigs as $assig){
            if ($assig == auth()->user()) {
                return $tarea;
            }
        } 
    }


    public function quejas(){
        return view('admin.inicioUsuario.formularios.quejas');
    }

    public function denuncias(){
        return view('admin.inicioUsuario.formularios.denuncias');
    }

    public function mejoras(){
        return view('admin.inicioUsuario.formularios.mejoras');
    }

    public function sugerencias(){
        return view('admin.inicioUsuario.formularios.sugerencias');
    }

    public function seguridad(){
        return view('admin.inicioUsuario.formularios.seguridad');
    }

    public function riesgos(){
        return view('admin.inicioUsuario.formularios.riesgos');
    }
}
