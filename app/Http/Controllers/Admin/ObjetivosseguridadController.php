<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyObjetivosseguridadRequest;
use App\Http\Requests\UpdateObjetivosseguridadRequest;
use App\Models\Empleado;
use App\Models\Norma;
use App\Models\Objetivosseguridad;
use App\Models\Team;
use App\Models\TiposObjetivosSistema;
use App\Models\VariablesObjetivosseguridad;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ObjetivosseguridadController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('objetivos_del_sistema_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Objetivosseguridad::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'objetivos_del_sistema_ver';
                $editGate = 'objetivos_del_sistema_editar';
                $deleteGate = 'objetivos_del_sistema_eliminar';
                $crudRoutePart = 'objetivosseguridads';

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
            $table->editColumn('objetivoseguridad', function ($row) {
                return $row->objetivoseguridad ? html_entity_decode(strip_tags($row->objetivoseguridad)) : '';
            });
            $table->editColumn('indicador', function ($row) {
                return $row->indicador ? $row->indicador : '';
            });
            $table->editColumn('responsable', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });

            $table->editColumn('formula', function ($row) {
                return $row->formula ? $row->formula : '';
            });

            $table->editColumn('meta', function ($row) {
                return $row->meta . $row->unidadmedida ? $row->meta . $row->unidadmedida : '';
            });

            $table->editColumn('frecuencia', function ($row) {
                return $row->frecuencia ? $row->frecuencia : '';
            });

            $table->editColumn('ano', function ($row) {
                return $row->ano ? $row->ano : '';
            });
            $table->editColumn('enlace', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.objetivosseguridads.index', compact('teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('objetivos_del_sistema_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $responsables = Empleado::alta()->with('area', 'puesto')->get();
        $tiposObjetivosSistemas = TiposObjetivosSistema::get();
        $normas = Norma::get();

        return view('admin.objetivosseguridads.create', compact('normas', 'responsables', 'tiposObjetivosSistemas'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('objetivos_del_sistema_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'objetivoseguridad' => 'required',
            'indicador' => 'required',
            'responsable_id' => 'required',
            'formula' => 'required',
            'verde' => 'required',
            'amarillo' => 'required',
            'rojo' => 'required',
            'unidadmedida' => 'required',
            'meta' => 'required',
            'frecuencia' => 'required',
            'revisiones' => 'required',
            'ano' => 'required',
            'tipo_objetivo_sistema_id' => 'required',
            'normas' => 'required',
        ]);
        $objetivosseguridad = Objetivosseguridad::create($request->all());
        $normas = array_map(function ($value) {
            return intval($value);
        }, $request->normas);
        $objetivosseguridad->normas()->sync($normas);

        return redirect()->route('admin.objetivos-seguridadsInsertar', ['id' => $objetivosseguridad->id])->with('success', 'Guardado con éxito');
    }

    public function edit(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivos_del_sistema_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tiposObjetivosSistemas = TiposObjetivosSistema::get();

        $objetivosseguridad->load('normas');
        $normas_seleccionadas = $objetivosseguridad->normas->pluck('id')->toArray();

        $normas = Norma::get();
        $responsables = Empleado::getaltaAll();

        return view('admin.objetivosseguridads.edit', compact('normas_seleccionadas', 'normas', 'objetivosseguridad', 'responsables', 'tiposObjetivosSistemas'));
    }

    public function update(UpdateObjetivosseguridadRequest $request, Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivos_del_sistema_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'objetivoseguridad' => 'required',
            'indicador' => 'required',
            'responsable_id' => 'required',
            'formula' => 'required',
            'verde' => 'required',
            'amarillo' => 'required',
            'rojo' => 'required',
            'unidadmedida' => 'required',
            'meta' => 'required',
            'frecuencia' => 'required',
            'revisiones' => 'required',
            'ano' => 'required',
            'tipo_objetivo_sistema_id' => 'required',
            'normas' => 'required',
        ]);
        $objetivosseguridad->update($request->all());
        $normas = array_map(function ($value) {
            return intval($value);
        }, $request->normas);
        $objetivosseguridad->normas()->sync($normas);

        return redirect()->route('admin.objetivosseguridads.index')->with('success', 'Editado con éxito');
    }

    public function show(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivos_del_sistema_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridad->load('team');

        return view('admin.objetivosseguridads.show', compact('objetivosseguridad'));
    }

    public function destroy(Objetivosseguridad $objetivosseguridad)
    {
        abort_if(Gate::denies('objetivos_del_sistema_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objetivosseguridad->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyObjetivosseguridadRequest $request)
    {
        Objetivosseguridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function ObjetivoInsert(Request $request)
    {
        $id = $request->all();
        $objetivos = Objetivosseguridad::find($id['id']);

        $formula_array = explode('!', $objetivos->formula);

        $finish_array = [];

        foreach ($formula_array as $result) {
            if (strstr($result, '$')) {
                array_push($finish_array, $result);
            }
        }

        $remplazo_formula = str_replace('!', '', $objetivos->formula);

        if ($remplazo_formula) {
            $up = $objetivos
                ->update(['formula' => $remplazo_formula]);
        }

        foreach ($finish_array as $key => $value) {
            VariablesObjetivosseguridad::create(['id_objetivo' => $objetivos->id, 'variable' => str_replace('.', '', $value)]);
        }

        return redirect()->action('Admin\ObjetivosseguridadController@evaluacionesInsert', ['id' => $objetivos->id]);
    }

    public function evaluacionesInsert(Request $request)
    {
        $id = $request->all();

        $objetivos = Objetivosseguridad::find($id['id']);

        return view('admin.objetivosseguridads.evaluacion')
            ->with('objetivos', $objetivos);
    }

    public function evaluacionesShow(Request $request)
    {
        $id = $request->all();
        $objetivos = Objetivosseguridad::find($id['id']);

        return view('admin.objetivosseguridads.evaluacion')
            ->with('objetivos', $objetivos);
    }

    public function objetivosDashboard(Request $request)
    {
        $objetivos = Objetivosseguridad::with('evaluacion_objetivos')->get();

        $tipos = TiposObjetivosSistema::get();

        return view('admin.objetivosseguridads.dashboard', compact('objetivos', 'tipos'));
    }
}
