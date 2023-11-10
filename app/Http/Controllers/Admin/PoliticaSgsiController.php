<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPoliticaSgsiRequest;
use App\Http\Requests\StorePoliticaSgsiRequest;
use App\Http\Requests\UpdatePoliticaSgsiRequest;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\PoliticaSgsi;
use App\Models\Team;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PoliticaSgsiController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('politica_sistema_gestion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PoliticaSgsi::with(['team', 'reviso'])->select(sprintf('%s.*', (new PoliticaSgsi)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'politica_sistema_gestion_ver';
                $editGate = 'politica_sistema_gestion_editar';
                $deleteGate = 'politica_sistema_gestion_eliminar';
                $crudRoutePart = 'politica-sgsis';

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
            $table->editColumn('nombre_politica', function ($row) {
                return $row->nombre_politica ? $row->nombre_politica : '';
            });
            $table->editColumn('politicasgsi', function ($row) {
                return $row->politicasgsi ? html_entity_decode(strip_tags($row->politicasgsi), ENT_QUOTES, 'UTF-8') : '';
                // return $row->politicasgsi ? strip_tags($row->politicasgsi) : '';
            });
            $table->editColumn('fecha_publicacion', function ($row) {
                return $row->fecha_publicacion ? $row->fecha_publicacion : '';
            });
            $table->editColumn('fecha_entrada', function ($row) {
                return $row->fecha_entrada ? $row->fecha_entrada : '';
            });
            $table->addColumn('reviso_politica', function ($row) {
                return $row->reviso ? $row->reviso->empleado->name : '';
            });
            $table->editColumn('puesto_reviso', function ($row) {
                return $row->reviso ? $row->reviso->puesto : '';
            });
            $table->editColumn('area_reviso', function ($row) {
                return $row->reviso ? $row->reviso->area->area : '';
            });
            $table->editColumn('fecha_revision', function ($row) {
                return $row->fecha_revision ? $row->fecha_revision : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $politicaSgsis = PoliticaSgsi::getAll();

        $teams = Team::get();

        $empleados = Empleado::alta()->with('area')->get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.politicaSgsis.index', compact('politicaSgsis', 'teams', 'empleados', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('politica_sistema_gestion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::alta()->with('area')->get();

        return view('admin.politicaSgsis.create', compact('empleados'));
    }

    public function store(StorePoliticaSgsiRequest $request)
    {
        abort_if(Gate::denies('politica_sistema_gestion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre_politica' => 'required',
            'politicasgsi' => 'required',
            'fecha_publicacion' => 'required|date',
            'fecha_entrada' => 'required|date',
            'fecha_revision' => 'required|date',
            'id_reviso_politica' => 'required',
        ]);

        $politicaSgsi = PoliticaSgsi::create($request->all());

        return redirect()->route('admin.politica-sgsis.index')->with('success', 'Guardado con éxito');
    }

    public function edit(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        $empleados = Empleado::alta()->with('area')->get();

        return view('admin.politicaSgsis.edit', compact('politicaSgsi', 'empleados'));
    }

    public function update(UpdatePoliticaSgsiRequest $request, PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre_politica' => 'required',
            'politicasgsi' => 'required',
            /*            'fecha_publicacion' => 'required|date',
           'fecha_entrada' => 'required|date',
           'fecha_revision' => 'required|date',*/
            'id_reviso_politica' => 'required',
        ]);

        $politicaSgsi->update($request->all());

        return redirect()->route('admin.politica-sgsis.index')->with('success', 'Editado con éxito');
    }

    public function show(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        return view('admin.politicaSgsis.show', compact('politicaSgsi'));
    }

    public function destroy(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyPoliticaSgsiRequest $request)
    {
        PoliticaSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function visualizacion()
    {
        $politicaSgsis = PoliticaSgsi::getAll();
        foreach ($politicaSgsis as $polsgsis) {
            if (! isset($polsgsis->reviso)) {
                $polsgsis->revisobaja = PoliticaSgsi::with('revisobaja')->first();
                $polsgsis->estemp = 'baja';
            } else {
                $polsgsis->estemp = 'alta';
            }
        }
        $organizacions = Organizacion::getFirst();

        return view('admin.politicaSgsis.visualizacion', compact('politicaSgsis', 'organizacions'));
    }
}
