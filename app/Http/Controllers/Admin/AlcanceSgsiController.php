<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAlcanceSgsiRequest;
use App\Models\AlcanceSgsi;
use App\Models\Empleado;
use App\Models\Norma;
use App\Models\Organizacion;
use App\Models\Team;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use PDF;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AlcanceSgsiController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('determinacion_alcance_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $alcanceSgsi = AlcanceSgsi::get(); // Puedes ajustar esto según tu lógica

        if ($request->ajax()) {
            $query = AlcanceSgsi::select(sprintf('%s.*', (new AlcanceSgsi)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'determinacion_alcance_ver';
                $editGate = 'determinacion_alcance_editar';
                $deleteGate = 'determinacion_alcance_eliminar';
                $crudRoutePart = 'alcance-sgsis';

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
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? strip_tags($row->nombre) : '';
            });
            $table->editColumn('alcancesgsi', function ($row) {
                return $row->alcancesgsi ? html_entity_decode(strip_tags($row->alcancesgsi), ENT_QUOTES, 'UTF-8') : '';
            });

            $table->editColumn('norma', function ($row) {
                return $row->normas ? $row->normas : '';
            });

            $table->editColumn('fecha_publicacion', function ($row) {
                return $row->fecha_publicacion ? $row->fecha_publicacion : '';
            });
            $table->editColumn('fecha_entrada', function ($row) {
                return $row->fecha_entrada ? $row->fecha_entrada : '';
            });
            $table->editColumn('reviso_alcance', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });
            $table->editColumn('puesto_reviso', function ($row) {
                return $row->empleado ? $row->empleado->puesto : '';
            });
            $table->editColumn('area_reviso', function ($row) {
                return $row->empleado ? $row->empleado->area->area : '';
            });
            $table->editColumn('fecha_revision', function ($row) {
                return $row->fecha_revision ? $row->fecha_revision : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();
        $empleados = Empleado::getAltaEmpleadosWithArea();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $direccion = $organizacion_actual->direccion;
        $rfc = $organizacion_actual->rfc;
        $normas = Norma::get();

        return view('admin.alcanceSgsis.index', compact('alcanceSgsi', 'teams', 'empleados', 'organizacion_actual', 'logo_actual', 'empresa_actual', 'direccion', 'rfc'));
    }

    public function create()
    {
        abort_if(Gate::denies('determinacion_alcance_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::with('area')->get();
        $normas = Norma::get();

        return view('admin.alcanceSgsis.create', compact('empleados', 'normas'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('determinacion_alcance_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre' => 'required|string',
            'alcancesgsi' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'fecha_revision' => 'required|date',
        ]);

        $alcanceSgsi = AlcanceSgsi::create([
            'nombre' =>  $request->input('nombre'),
            'alcancesgsi' =>  $request->input('alcancesgsi'),
            'fecha_publicacion'  =>  $request->input('fecha_publicacion'),
            'fecha_revision'  =>  $request->input('fecha_revision'),
            'estatus'  =>  'pendiente'
        ]);

        return redirect()->route('admin.alcance-sgsis.index')->with('success', 'Guardado con éxito');
    }

    public function edit(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('normas');
        $normas_seleccionadas = $alcanceSgsi->normas->pluck('id')->toArray();

        $normas = Norma::get();
        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('admin.alcanceSgsis.edit', compact('alcanceSgsi', 'empleados', 'normas', 'normas_seleccionadas'));
    }

    public function aprove(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('normas');
        $normas_seleccionadas = $alcanceSgsi->normas->pluck('id')->toArray();

        $normas = Norma::get();
        $empleados = Empleado::alta()->with('area')->get();

        return view('admin.alcanceSgsis.aprove', compact('alcanceSgsi', 'empleados', 'normas', 'normas_seleccionadas'));
    }

    public function update(Request $request, AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'alcancesgsi' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'fecha_revision' => 'required|date'
        ]);

        $alcanceSgsi->update([
            'nombre' =>  $request->input('nombre'),
            'alcancesgsi' =>  $request->input('alcancesgsi'),
            'fecha_publicacion'  =>  $request->input('fecha_publicacion'),
            'fecha_revision'  =>  $request->input('fecha_revision'),
            'estatus'  =>  'pendiente'
        ]);

        return redirect()->route('admin.alcance-sgsis.index')->with('success', 'Editado con éxito');
    }

    public function show(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('team');
        $normas = Norma::get();

        return view('admin.alcanceSgsis.show', compact('alcanceSgsi', 'normas'));
    }

    public function destroy(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyAlcanceSgsiRequest $request)
    {
        AlcanceSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function pdf()
    {

        $alcances = AlcanceSgsi::get();
        $organizacions = Organizacion::getFirst();

        $pdf = PDF::loadView('alcances', compact('alcances', 'organizacions'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('alcances.pdf');
    }
}