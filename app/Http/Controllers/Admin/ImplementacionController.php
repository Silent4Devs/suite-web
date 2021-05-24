<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanBaseActividade;
use Illuminate\Http\Request;
use App\Functions\Porcentaje;
use App\Models\User;
use App\Models\ActividadFase;

class implementacionController extends Controller
{
    

    public function index()
    {
        // dd(ActividadFase::with('plan_base_actividades')->get());

        $fases = ActividadFase::with('plan_base_actividades')->get();
        

        // PlanBaseActividade::with('fase')->get()

        $planbase = PlanBaseActividade::with('actividad_fase')->get();
        $responsable = User::get();
        $responsablenom = User::select('name')->where('id', '=', '3');
        //dd($planbase, $responsable, $responsablenom);
        return view('admin.implementacions.index', compact('planbase', 'responsable', 'fases'))
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

}
