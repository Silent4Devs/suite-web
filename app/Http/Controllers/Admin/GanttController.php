<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanBaseActividade;
use App\Models\User;
use Illuminate\Http\Request;

class GanttController extends Controller
{
    //

    public function index()
    {
        $planbase = PlanBaseActividade::getAll();
        $responsable = User::getAll();
        $responsablenom = $responsable->where('id', '=', '3');

        //dd($planbase, $responsable, $responsablenom);
        return view('admin.gantt.index', compact('planbase', 'responsable'))
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

                    return response()->json(['success' => true]);
                    break;
            }
        }
    }
}
