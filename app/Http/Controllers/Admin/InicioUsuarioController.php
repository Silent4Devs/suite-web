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



        $gantt_path = 'storage/gantt/';

        $version_gantt = glob($gantt_path . "gantt_inicial*.json");

        $path_gantt = end($version_gantt);

        $file_gantt = json_decode(file_get_contents($path_gantt));

        $actividades = collect($file_gantt->tasks)->filter(function($actividad){
            return count($actividad->assigs) == 0;
        });

        dd($actividades);


        $plan_base = PlanBaseActividade::get();

        $auditorias_anual = AuditoriaAnual::get();

        $recursos = Recurso::whereHas('empleados', function($query)use($usuario){
            $query->where('empleados.id',$usuario->id);
        })->get();

        
        

        return view('admin.inicioUsuario.index', compact('usuario', 'file_gantt', 'plan_base', 'auditorias_anual', 'recursos'));
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
}
