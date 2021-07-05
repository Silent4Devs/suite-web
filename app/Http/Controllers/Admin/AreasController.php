<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAreaRequest;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use App\Models\Team;
use App\Models\Grupo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AreasController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Area::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'area_show';
                $editGate      = 'area_edit';
                $deleteGate    = 'area_delete';
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
                return $row->id ? $row->id : "";
            });
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : "";
            });
            $table->editColumn('grupo', function ($row) {
                return $row->grupo ? $row->grupo->nombre : "";
            });

            $table->editColumn(
                'reporta',
                function ($row) {
                    return $row->areas->get(0) ? $row->areas->get(0)['area'] : "";
                }
            );

            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $teams = Team::get();
        $grupoarea= Grupo::get();
        $numero_areas=Area::count();


        return view('admin.areas.index', compact('teams','direccion_exists','numero_areas'));
    }

    public function create()
    {
        abort_if(Gate::denies('area_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoareas = Grupo::get();
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $areas=Area::with('areas')->get();
       // dd($direccion_exists);



        return view('admin.areas.create', compact('grupoareas', 'direccion_exists', 'areas' ));
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

        return redirect()->route('admin.areas.index')->with("success",'Guardado con éxito');
    }

    public function edit(Area $area)
    {
        abort_if(Gate::denies('area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupoarea = Grupo::get();
        $direccion_exists = Area::select('id_reporta')->whereNull('id_reporta')->exists();
        $area->load('team','grupo');

        return view('admin.areas.edit', compact('area'))->with('grupoareas', $grupoarea, 'direcciones_exists', $direccion_exists);
    }

    public function update(UpdateAreaRequest $request, Area $area)
    {
        $area->update($request->all());

        return redirect()->route('admin.areas.index')->with("success",'Editado con éxito');
    }

    public function show(Area $area)
    {
        abort_if(Gate::denies('area_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area->load('team');

        return view('admin.areas.show', compact('area'));
    }

    public function destroy(Area $area)
    {
        abort_if(Gate::denies('area_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area->delete();

        return back();
    }

    public function massDestroy(MassDestroyAreaRequest $request)
    {
        Area::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function obtenerAreasPorGrupo (Area $area){


        $grupoarea = Grupo::get();
        $area->load('team','grupo');
        $numero_areas=Area::count();



        return view('admin.areas.areas-grupo', compact('grupoarea','area','numero_areas'));

    }
}
