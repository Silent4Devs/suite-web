<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanaccionCorrectivaRequest;
use App\Http\Requests\StorePlanaccionCorrectivaRequest;
use App\Models\AccionCorrectiva;
use App\Models\PlanaccionCorrectiva;
use App\Models\Puesto;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Flash;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlanaccionCorrectivaController extends Controller
{
    public function index(Request $request)
    {
        //        abort_if(Gate::denies('planaccion_correctiva_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PlanaccionCorrectiva::with(['accioncorrectiva', 'responsable', 'team'])->select(sprintf('%s.*', (new PlanaccionCorrectiva)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'planaccion_correctiva_show';
                $editGate = 'planaccion_correctiva_edit';
                $deleteGate = 'planaccion_correctiva_delete';
                $crudRoutePart = 'planaccion-correctivas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('accioncorrectiva_tema', function ($row) {
                return $row->accioncorrectiva ? $row->accioncorrectiva->tema : '';
            });

            $table->editColumn('accioncorrectiva.fecharegistro', function ($row) {
                return $row->accioncorrectiva ? (is_string($row->accioncorrectiva) ? $row->accioncorrectiva : $row->accioncorrectiva->fecharegistro) : '';
            });
            $table->editColumn('actividad', function ($row) {
                return $row->actividad ? $row->actividad : '';
            });
            $table->addColumn('responsable_name', function ($row) {
                return $row->responsable ? $row->responsable->name : '';
            });

            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? PlanaccionCorrectiva::ESTATUS_SELECT[$row->estatus] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'accioncorrectiva', 'responsable']);

            return $table->make(true);
        }

        $accion_correctivas = AccionCorrectiva::get();
        $users = User::getAll();
        $teams = Team::get();

        return view('admin.planaccionCorrectivas.index', compact('accion_correctivas', 'users', 'teams'));
    }

    public function create()
    {
        //        abort_if(Gate::denies('planaccion_correctiva_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accioncorrectivas = AccionCorrectiva::all()->pluck('tema', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::getAll()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.planaccionCorrectivas.create', compact('accioncorrectivas', 'responsables'));
    }

    public function storeEdit(Request $request)
    {
        //dd(request()->all());
        $planaccionCorrectiva = PlanaccionCorrectiva::create($request->all());
        $accionCorrectiva = AccionCorrectiva::find($planaccionCorrectiva->accioncorrectiva_id);
        $users = User::getAll();
        $puestos = Puesto::getAll();
        $responsables = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $nombrereportas = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $puestoreportas = $puestos->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = $puestos->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $id = $accionCorrectiva->id;
        $PlanAccion = PlanaccionCorrectiva::select('planaccion_correctivas.id', 'planaccion_correctivas.accioncorrectiva_id', 'planaccion_correctivas.actividad', 'planaccion_correctivas.fechacompromiso', 'planaccion_correctivas.estatus', 'planaccion_correctivas.responsable_id', 'users.name')
            ->join('accion_correctivas', 'planaccion_correctivas.accioncorrectiva_id', '=', 'accion_correctivas.id')
            ->join('users', 'planaccion_correctivas.responsable_id', '=', 'users.id')
            ->where('planaccion_correctivas.accioncorrectiva_id', '=', $id)
            ->orderBy('planaccion_correctivas.id', 'ASC')
            ->get();
        $Count = $PlanAccion->count();
        $users = User::getAll();
        $tab = true;

        Flash::success('Se ha registrado correctamente actividad del plan de acción');

        return view('admin.accionCorrectivas.edit', compact('accionCorrectiva', 'responsables', 'planaccionCorrectiva', 'nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas', 'PlanAccion', 'id', 'Count', 'users', 'tab'));
    }

    public function store(StorePlanaccionCorrectivaRequest $request)
    {
        $planaccionCorrectiva = PlanaccionCorrectiva::create($request->all());
        //dd($planaccionCorrectiva);
        $id = $request->get('accioncorrectiva_id');
        Flash::success('Se ha registrado correctamente la actividad del plan de acción');

        //return redirect()->route('admin.accionCorrectivas.edit');
        return redirect('admin/plan-correctiva?param='.$id);
        //return view('admin.accionCorrectivas.plan_accion')->with('ids', $id)->with('users', $users);
    }

    public function edit(PlanaccionCorrectiva $planaccionCorrectiva)
    {
        //        abort_if(Gate::denies('planaccion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accioncorrectivas = AccionCorrectiva::all()->pluck('tema', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::getAll()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planaccionCorrectiva->load('accioncorrectiva', 'responsable', 'team');
        //dd($planaccionCorrectiva);

        return view('admin.planaccionCorrectivas.edit', compact('accioncorrectivas', 'responsables', 'planaccionCorrectiva'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            switch ($request->name) {
                case 'actividad':
                    $palanaccion = PlanaccionCorrectiva::findOrFail($id);
                    $palanaccion->actividad = $request->value;
                    $palanaccion->save();

                    return response()->json(['success' => true]);
                    break;
                case 'estatus':
                    $palanaccion = PlanaccionCorrectiva::findOrFail($id);
                    $palanaccion->estatus = $request->value;
                    $palanaccion->save();

                    return response()->json(['success' => true]);
                    break;
                case 'fechacompromiso':
                    $fecha = str_replace(' ', '', trim($request->value));
                    $data = Carbon::parse($fecha)->format('d-m-Y');
                    $palanaccion = PlanaccionCorrectiva::findOrFail($id);
                    $palanaccion->fechacompromiso = $data;
                    $palanaccion->save();

                    return response()->json(['success' => true]);
                    break;
                case 'responsable':
                    $palanaccion = PlanaccionCorrectiva::findOrFail($id);
                    $palanaccion->responsable_id = $request->value;
                    $palanaccion->save();

                    return response()->json(['success' => true]);
                    break;
            }
        }

        /*$planaccionCorrectiva->update($request->all());
        return redirect()->route('admin.planaccion-correctivas.index');*/
    }

    public function show(PlanaccionCorrectiva $planaccionCorrectiva)
    {
        //        abort_if(Gate::denies('planaccion_correctiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planaccionCorrectiva->load('accioncorrectiva', 'responsable', 'team');

        return view('admin.planaccionCorrectivas.show', compact('planaccionCorrectiva'));
    }

    public function destroy(PlanaccionCorrectiva $planaccionCorrectiva)
    {
        //        abort_if(Gate::denies('planaccion_correctiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planaccionCorrectiva->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanaccionCorrectivaRequest $request)
    {
        PlanaccionCorrectiva::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function planformulario(Request $request)
    {
        $users = User::getAll();
        $id = request()->param;
        $PlanAccion = PlanaccionCorrectiva::select('planaccion_correctivas.id', 'planaccion_correctivas.accioncorrectiva_id', 'planaccion_correctivas.actividad', 'planaccion_correctivas.fechacompromiso', 'planaccion_correctivas.estatus', 'planaccion_correctivas.responsable_id', 'users.name')
            ->join('accion_correctivas', 'planaccion_correctivas.accioncorrectiva_id', '=', 'accion_correctivas.id')
            ->join('users', 'planaccion_correctivas.responsable_id', '=', 'users.id')
            ->where('planaccion_correctivas.accioncorrectiva_id', '=', $id)
            ->orderBy('planaccion_correctivas.id', 'ASC')
            ->get();
        $Count = $PlanAccion->count();

        return view('admin.accionCorrectivas.plan_accion')->with('ids', $id)->with('users', $users)->with('Count', $Count)->with('Planaccion', $PlanAccion);
    }

    public function changeplanact(Request $request)
    {
        try {
            $id = $request->input('id');
            $actividad = $request->actividad;
            $fechacompromiso = $request->fechacompromi;
            $estatus = $request->estado;
            $planaccion = AccionCorrectiva::findOrFail($id);
            $planaccion->save();
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}
