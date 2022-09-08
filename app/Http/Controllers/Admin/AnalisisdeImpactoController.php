<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AnalisisImpacto;
use App\Models\Organizacion;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class AnalisisdeImpactoController extends Controller
{
    public function menu()
    {
        return view('admin.analisis-impacto.menu-buttons');
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('amenazas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = AnalisisImpacto::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'analisis-impacto';

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
            $table->editColumn('fecha_entrevista', function ($row) {
                return $row->fecha_entrevista ? $row->fecha_entrevista : '';
            });
            $table->editColumn('entrevistado', function ($row) {
                return $row->entrevistado ? $row->entrevistado : '';
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : '';
            });
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : '';
            });
            $table->editColumn('direccion', function ($row) {
                return $row->direccion ? $row->direccion : '';
            });
            $table->editColumn('extencion', function ($row) {
                return $row->extencion ? $row->extencion : '';
            });
            $table->editColumn('correo', function ($row) {
                return $row->correo ? $row->correo : '';
            });
            $table->editColumn('id_proceso', function ($row) {
                return $row->id_proceso ? $row->id_proceso : '';
            });
            $table->editColumn('nombre_proceso', function ($row) {
                return $row->nombre_proceso ? $row->nombre_proceso : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.analisis-impacto.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        $cuestionario = new AnalisisImpacto();

        return view('admin.analisis-impacto.create', compact('cuestionario'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('amenazas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $request->validate([
        //     'nombre' => 'required|string',
        //     'dias' => 'required|int',
        //     'afectados' => 'required|int',
        //     'tipo_conteo' => 'required|int',
        //     'inicio_conteo' => 'required|int',
        //     'incremento_dias' => 'required|int',
        //     'periodo_corte' => 'required|int',
        // ]);
      

        $cuestionario = AnalisisImpacto::create($request->all());

        // Flash::success('Cuestionario añadido satisfactoriamente.');

        return redirect()->route('admin.analisis-impacto.edit', ['id' => $cuestionario]);
    }

    public function show($id)
    {
        abort_if(Gate::denies('amenazas_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AnalisisImpacto::find($id);

        return view('admin.analisis-impacto.show', compact('cuestionario'));
    }

    public function edit(Request $request, $id)
    {
        abort_if(Gate::denies('amenazas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuestionario = AnalisisImpacto::find($id);
        // dd($cuestionario);

        if (empty($cuestionario)) {
            Flash::error('Cuestionario no encontrado');

            return redirect(route('admin.analisis-impacto.index'));
        }

        return view('admin.analisis-impacto.edit', ['id' => $cuestionario], compact('cuestionario'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('amenazas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuestionario = AnalisisImpacto::find($id);
        // dd($request->all());
        $cuestionario->update($request->all());

        Flash::success('Cuestionario actualizado correctamente.');

        return redirect(route('admin.analisis-impacto.index'));
    }

    public function destroy($id)
    {
        $cuestionario = AnalisisImpacto::find($id);
        $cuestionario->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}
