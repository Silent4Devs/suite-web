<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\ClasificacionesAuditorias;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ClasificacionesAuditoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        abort_if(Gate::denies('clasificaciones_auditorias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $clasifaudit = ClasificacionesAuditorias::all();

        // dd($clasifaudit);
        return view('admin.clasificacionAuditorias.index', compact('clasifaudit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function datatable(Request $request)
    {
        abort_if(Gate::denies('clasificaciones_auditorias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = ClasificacionesAuditorias::orderByDesc('id')->get();

            foreach ($query as $cf) {
                $borrado = AuditoriaInternasHallazgos::where('clasificacion_id', '=', $cf->id)->exists();
                $cf->borrado = $borrado;
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->addColumn('id_clasificacion', function ($row) {
                return $row->identificador ? $row->identificador : '';
            });
            $table->addColumn('nombre', function ($row) {
                return $row->nombre_clasificaciones ? $row->nombre_clasificaciones : '';
            });
            $table->addColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->addColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    public function create()
    {
        //
        abort_if(Gate::denies('clasificaciones_auditorias_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clasificacionAuditorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('clasificaciones_auditorias_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required',
        ]);

        try {
            $nuevaClasificacion = ClasificacionesAuditorias::create([
                'identificador' => $request->identificador,
                'nombre_clasificaciones' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Clasificación creada. La clasificación fue creada exitosamente.',
                'redirect_url' => route('admin.auditoria-clasificacion') // Ruta de redirección
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un problema al crear la clasificación. Inténtalo nuevamente.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClasificacionesAuditorias $clasificacionesAuditorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        abort_if(Gate::denies('clasificaciones_auditorias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $clasif = ClasificacionesAuditorias::find($id);

        // dd($clasif);
        return view('admin.clasificacionAuditorias.edit', compact('clasif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        abort_if(Gate::denies('clasificaciones_auditorias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required',
        ]);
        // dd('validacion');
        try {
            $editClasificacion = ClasificacionesAuditorias::find($id);

            $editClasificacion->update([
                'identificador' => $request->identificador,
                'nombre_clasificaciones' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Clasificación modificar. La clasificación fue modificar exitosamente.',
                'redirect_url' => route('admin.auditoria-clasificacion') // Ruta de redirección
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un problema al modificar la clasificación. Inténtalo nuevamente.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('clasificaciones_auditorias_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $deleteClasificacion = ClasificacionesAuditorias::find($id);

        $deleteClasificacion->delete();

        return redirect(route('admin.auditoria-clasificacion'));
    }
}
