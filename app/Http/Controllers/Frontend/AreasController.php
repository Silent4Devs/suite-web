<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAreaRequest;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use App\Models\Grupo;
use App\Models\Organizacion;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AreasController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('configuracion_area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Area::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'configuracion_area_show';
                $editGate = 'configuracion_area_edit';
                $deleteGate = 'configuracion_area_delete';
                $crudRoutePart = 'areas';

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
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : '';
            });
            $table->editColumn('grupo', function ($row) {
                return $row->grupo ? $row->grupo->nombre : '';
            });
            $table->editColumn(
                'reporta',
                function ($row) {
                    return $row->supervisor ? $row->supervisor->area : '';
                }
            );
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $teams = Team::get();
        $grupoarea = Grupo::get();
        $numero_areas = Area::count();

        return view('frontend.areas.index', compact('teams', 'direccion_exists', 'numero_areas'));
    }

    public function create()
    {
        abort_if(Gate::denies('configuracion_area_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoareas = Grupo::get();
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $areas = Area::with('areas')->get();

        return view('frontend.areas.create', compact('grupoareas', 'direccion_exists', 'areas'));
    }

    public function store(StoreAreaRequest $request)
    {
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $validateReporta = 'nullable|exists:areas,id';
        if ($direccion_exists) {
            $validateReporta = 'required|exists:areas,id';
        }

        $request->validate([
            'area' => 'required|string',
            'id_grupo' => 'required|exists:grupos,id',
            'id_reporta' => $validateReporta,
            'descripcion' => 'required|string',

        ]);

        $area = Area::create($request->all());

        return redirect()->route('areas.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Area $area)
    {
        abort_if(Gate::denies('configuracion_area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoareas = Grupo::get();
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $areas = Area::with('areas')->get();

        return view('frontend.areas.edit', compact('grupoareas', 'direccion_exists', 'areas', 'area'));
    }

    public function update(UpdateAreaRequest $request, Area $area)
    {
        $primer_nodo = Area::select('id', 'id_reporta')->whereNull('id_reporta')->first();
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $validateReporta = 'nullable|exists:areas,id';

        if ($direccion_exists) {
            if ($primer_nodo->id == intval($area->id)) {
                $validateReporta = 'nullable|exists:areas,id';
            } else {
                $validateReporta = 'required|exists:areas,id';
            }
        }

        $request->validate([
            'area' => 'required|string',
            'id_grupo' => 'required|exists:grupos,id',
            'id_reporta' => $validateReporta,
            'descripcion' => 'required|string',

        ]);

        $area->update([
            'area' => $request->area,
            'id_grupo' =>  $request->id_grupo,
            'id_reporta' =>  $request->id_reporta,
            'descripcion' =>  $request->descripcion,

        ]);

        return redirect()->route('areas.index')->with('success', 'Editado con éxito');
    }

    public function show(Area $area)
    {
        abort_if(Gate::denies('configuracion_area_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area->load('team', 'grupo');

        return view('frontend.areas.show', compact('area'));
    }

    public function destroy(Area $area)
    {
        abort_if(Gate::denies('configuracion_area_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyAreaRequest $request)
    {
        Area::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function obtenerAreasPorGrupo()
    {
        $grupos = Grupo::with('areas')->get();
        $numero_grupos = Grupo::count();

        return view('frontend.areas.areas-grupo', compact('grupos', 'numero_grupos'));
    }

    public function renderJerarquia(Request $request)
    {
        //abort_if(Gate::denies('organizacion_area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $numero_grupos = Grupo::count();

        $areasTree = Area::with(['supervisor.children', 'supervisor.supervisor', 'grupo', 'children.supervisor', 'children.children'])->whereNull('id_reporta')->first(); //Eager loading

        if ($request->ajax()) {
            // La construccion del arbol necesita un primer nodo (NULL)
            $areasTree = Area::with(['supervisor.children', 'supervisor.supervisor', 'grupo', 'children.supervisor', 'children.children'])->whereNull('id_reporta')->first(); //Eager loading

            return $areasTree->toJson();
        }

        $rutaImagenes = asset('storage/empleados/imagenes/');
        $grupos = Grupo::with('areas')->get();
        $organizacionDB = Organizacion::getFirst();
        $organizacion = !is_null($organizacionDB) ? Organizacion::select('empresa')->first()->empresa : 'la organización';
        $org_foto = !is_null($organizacionDB) ? url('images/' . DB::table('organizacions')->select('logotipo')->first()->logotipo) : url('img/Silent4Business-Logo-Color.png');
        $areas_sin_grupo = Area::whereDoesntHave('grupo')->get();

        return view('frontend.areas.jerarquia', compact('areasTree', 'rutaImagenes', 'organizacion', 'org_foto', 'grupos', 'numero_grupos', 'areas_sin_grupo'));
    }
}
