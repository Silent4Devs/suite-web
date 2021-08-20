<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Team;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\PlanImplementacion;
use App\Http\Controllers\Controller;
use App\Models\Minutasaltadireccion;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Requests\StoreMinutasaltadireccionRequest;
use App\Http\Requests\UpdateMinutasaltadireccionRequest;
use App\Http\Requests\MassDestroyMinutasaltadireccionRequest;

class MinutasaltadireccionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('minutasaltadireccion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Minutasaltadireccion::with(['responsable', 'team','participantes','planes'])->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'minutasaltadireccion_show';
                $editGate      = 'minutasaltadireccion_edit';
                $deleteGate    = 'minutasaltadireccion_delete';
                $crudRoutePart = 'minutasaltadireccions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('tema_reunion', function ($row) {
                return $row->tema_reunion ? $row->tema_reunion : '';
            });
            $table->editColumn('fechareunion', function ($row) {
                return $row->fechareunion ? $row->fechareunion : "";
            });
            $table->addColumn('responsable', function ($row) {
                return $row->responsable ? ['name'=> $row->responsable->name,'avatar'=> $row->responsable->avatar ]: '';
            });
            $table->editColumn('participantes', function ($row) {
                return $row->participantes? $row->participantes : "";
            });

            // $table->editColumn('archivo', function ($row) {
            //     return $row->archivo ? '<a href="' . $row->archivo->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            // });

            $table->rawColumns(['actions', 'placeholder', 'responsable', 'archivo']);

            return $table->make(true);
        }

        $users = User::get();
        $teams = Team::get();

        return view('admin.minutasaltadireccions.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('minutasaltadireccion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsablereunions = Empleado::select('id','name')->get();



        return view('admin.minutasaltadireccions.create', compact('responsablereunions'));
    }

    public function store(StoreMinutasaltadireccionRequest $request)
    {


        $minutasaltadireccion = Minutasaltadireccion::create($request->all());

        if ($request->input('archivo', false)) {
            $minutasaltadireccion->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $minutasaltadireccion->id]);
        }

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $minutasaltadireccion->planes()->sync($request->plan_accion);
        }

        $arrstrParticipantes=explode(',',$request->participantes);
        $participantes=array_map(function($valor){
            return intval($valor);
        },$arrstrParticipantes);

        $minutasaltadireccion->participantes()->sync($participantes);

        return redirect()->route('admin.minutasaltadireccions.index')->with("success", 'Guardado con éxito');
    }

    public function edit(Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsablereunions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $minutasaltadireccion->load('responsablereunion', 'team', 'planes');

        $planes_implementacion = PlanImplementacion::where('id', '!=', 1)->get();
        $planes_seleccionados = array();
        if ($minutasaltadireccion->planes) {
            foreach ($minutasaltadireccion->planes as $plan) {
                array_push($planes_seleccionados, $plan->id);
            }
        }

        return view('admin.minutasaltadireccions.edit', compact('responsablereunions', 'minutasaltadireccion','planes_seleccionados'));
    }

    public function update(UpdateMinutasaltadireccionRequest $request, Minutasaltadireccion $minutasaltadireccion)
    {
        $minutasaltadireccion->update($request->all());

        if ($request->input('archivo', false)) {
            if (!$minutasaltadireccion->archivo || $request->input('archivo') !== $minutasaltadireccion->archivo->file_name) {
                if ($minutasaltadireccion->archivo) {
                    $minutasaltadireccion->archivo->delete();
                }

                $minutasaltadireccion->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($minutasaltadireccion->archivo) {
            $minutasaltadireccion->archivo->delete();
        }

        if (isset($request->plan_accion)) {
            // $planImplementacion = PlanImplementacion::find(intval($request->plan_accion)); // Necesario se carga inicialmente el Diagrama Universal de Gantt
            $minutasaltadireccion->planes()->sync($request->plan_accion);
        }

        return redirect()->route('admin.minutasaltadireccions.index')->with("success", 'Editado con éxito');
    }

    public function show(Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minutasaltadireccion->load('responsablereunion', 'team');

        return view('admin.minutasaltadireccions.show', compact('minutasaltadireccion'));
    }

    public function destroy(Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minutasaltadireccion->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyMinutasaltadireccionRequest $request)
    {
        Minutasaltadireccion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('minutasaltadireccion_create') && Gate::denies('minutasaltadireccion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Minutasaltadireccion();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function createPlanAccion(Minutasaltadireccion $id)
    {
        $planImplementacion  = new PlanImplementacion();
        $modulo = $id;
        $modulo_name = 'Matríz de Requisitos Legales';
        $referencia = $modulo->nombrerequisito;
        $urlStore = route('admin.matriz-requisito-legales.storePlanAccion', $id);
        return view('admin.planesDeAccion.create', compact('planImplementacion', 'modulo_name', 'modulo', 'referencia', 'urlStore'));
    }

    public function storePlanAccion(Request $request, Minutasaltadireccion $id)
    {
        $request->validate([
            'parent' => 'required|string',
            'norma' => 'required|string',
            'modulo_origen' => 'required|string',
            'objetivo' => 'required|string',
        ], [
            'parent.required' => 'Debes de definir un nombre para el plan de acción',
            'norma.required' => 'Debes de definir una norma para el plan de acción',
            'modulo_origen.required' => 'Debes de definir un módulo de origen para el plan de acción',
            'objetivo.required' => 'Debes de definir un objetivo para el plan de acción',
        ]);

        $planImplementacion = new PlanImplementacion(); // Necesario se carga inicialmente el Diagrama Universal de Gantt
        $planImplementacion->tasks = [];
        $planImplementacion->canAdd = true;
        $planImplementacion->canWrite = true;
        $planImplementacion->canWriteOnParent = true;
        $planImplementacion->changesReasonWhy = false;
        $planImplementacion->selectedRow = 0;
        $planImplementacion->zoom = "3d";
        $planImplementacion->parent = $request->parent;
        $planImplementacion->norma = $request->norma;
        $planImplementacion->modulo_origen = $request->modulo_origen;
        $planImplementacion->objetivo = $request->objetivo;
        $planImplementacion->elaboro_id = auth()->user()->empleado->id;

       $minuta = $id;
       $minuta->planes()->save($planImplementacion);

        return redirect()->route('admin.minutasaltadireccions.index')->with('success', 'Plan de Acción' . $planImplementacion->parent . ' creado');
    }
}
