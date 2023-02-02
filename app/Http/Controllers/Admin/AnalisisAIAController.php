<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AjustesAIA;
use App\Models\AnalisisAIA;
use Illuminate\Http\Request;
use App\Models\Organizacion;
use Flash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class AnalisisAIAController extends Controller
{
  
    public function index(Request $request)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = AnalisisAIA::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'matriz_bia_cuestionario_ver_pendiente';
                $editGate = 'matriz_bia_cuestionario_editar';
                $deleteGate = 'matriz_bia_cuestionario_eliminar';
                $crudRoutePart = 'analisis-aia';

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
            $table->editColumn('fecha_entrevista', function ($row) {
                return $row->fecha_entrevista ? $row->fecha_entrevista : '';
            });
            $table->editColumn('id_aplicacion', function ($row) {
                return $row->id_aplicacion ? $row->id_aplicacion : '';
            });
            $table->editColumn('nombre_aplicacion', function ($row) {
                return $row->nombre_aplicacion ? $row->nombre_aplicacion : '';
            });
            $table->editColumn('entrevistado', function ($row) {
                return $row->entrevistado ? $row->entrevistado : '';
            });
            $table->editColumn('puesto', function ($row) {
                return $row->puesto ? $row->puesto : '';
            });
            $table->editColumn('correo', function ($row) {
                return $row->correo ? $row->correo : '';
            });
            $table->editColumn('extencion', function ($row) {
                return $row->extencion ? $row->extencion : '';
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

        return view('admin.analisis-aia.index', compact('logo_actual', 'empresa_actual'));
    }

    
    public function create()
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = new AnalisisAIA();

        return view('admin.analisis-aia.create', compact('cuestionario'));
    }

    
    public function store(Request $request)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $cuestionario = AnalisisAIA::create($request->all());

        return redirect()->route('admin.analisis-aia.edit', ['id' => $cuestionario]);
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuestionario = AnalisisAIA::find($id);

        if (empty($cuestionario)) {
            Flash::error('Cuestionario no encontrado');
            return redirect(route('admin.analisis-aia.index'));
        }

        return view('admin.analisis-aia.edit', ['id' => $cuestionario], compact('cuestionario'));
    }

   
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuestionario = AnalisisAIA::find($id);
        $cuestionario->update($request->all());
        Flash::success('Cuestionario actualizado correctamente.');

        return redirect(route('admin.analisis-aia.index'));
    }

   
    public function destroy($id)
    {
        abort_if(Gate::denies('matriz_bia_cuestionario_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AnalisisAIA::find($id);
        $cuestionario->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function matriz()
    {
        abort_if(Gate::denies('matriz_bia_matriz'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario = AnalisisAIA::with('proporcionaInformacion','proporcionaMantenimientos')->get();
        return view('admin.analisis-aia.matriz', compact('cuestionario'));
    }

    public function ajustes()
    {
        abort_if(Gate::denies('matriz_bia_matriz_ajustes'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = 1;
        $cuestionario = AjustesAIA::find($id);
        if (empty($cuestionario)) {
            Flash::error('Ajustes no encontrados');
            return redirect(route('admin.analisis-aia.matriz'));
        }
        return view('admin.analisis-aia.ajustes', compact('cuestionario'));
    }

    public function updateAjustesAIA(Request $request, $id)
    {
        abort_if(Gate::denies('matriz_bia_matriz_ajustes_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cuestionario =  AjustesAIA::find($id);
        $cuestionario->update($request->all());
        Flash::success('Ajustes aplicados satisfactoriamente.');

        return redirect()->route('admin.analisis-aia.matriz');
    }
}
