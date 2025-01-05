<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\ClausulasAuditorias;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ClausulasAuditoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('clausulas_auditorias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $clausaudit = ClausulasAuditorias::all();

        return view('admin.clausulasAuditorias.index', compact('clausaudit'));
    }

    public function datatable(Request $request)
    {
        abort_if(Gate::denies('clausulas_auditorias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = ClausulasAuditorias::orderByDesc('id')->get();

            foreach ($query as $cl) {
                $borrado = AuditoriaInternasHallazgos::where('clausula_id', '=', $cl->id)->exists();
                $cl->borrado = $borrado;
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->addColumn('id_clausula', function ($row) {
                return $row->identificador ? $row->identificador : '';
            });
            $table->addColumn('nombre', function ($row) {
                return $row->nombre_clausulas ? $row->nombre_clausulas : '';
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('clausulas_auditorias_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clausulasAuditorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('clausulas_auditorias_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validatedData = $request->validate([
            'identificador' => 'unique:clausulas_auditorias,identificador', // Ignora el actual en la validación
            'nombre' => 'required|unique:clausulas_auditorias,nombre_clausulas',
        ], [
            'identificador.unique' => 'El identificador ya está registrado. Por favor, elige uno diferente.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre ya existe. Por favor, selecciona otro.',
        ]);

        try {
            $nuevaClausulas = new ClausulasAuditorias;
            $nuevaClausulas->create([
                'identificador' => $validatedData['identificador'],
                'nombre_clausulas' => $validatedData['nombre'],
                'descripcion' => $request->descripcion,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Cláusula creada. La cláusula fue creada exitosamente.',
                'redirect_url' => route('admin.auditoria-clausula'), // Ruta de redirección
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un problema al crear la cláusula. Inténtalo nuevamente.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClausulasAuditorias $clausulasAuditorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        abort_if(Gate::denies('clausulas_auditorias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $claus = ClausulasAuditorias::find($id);

        // dd($clasif);
        return view('admin.clausulasAuditorias.edit', compact('claus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        //
        abort_if(Gate::denies('clausulas_auditorias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validatedData = $request->validate([
            'identificador' => 'unique:clausulas_auditorias,identificador,'.$id.'', // Ignora el actual en la validación
            'nombre' => 'required|unique:clausulas_auditorias,nombre_clausulas,'.$id.'',
        ], [
            'identificador.unique' => 'El identificador ya está registrado. Por favor, elige uno diferente.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre ya existe. Por favor, selecciona otro.',
        ]);

        try {
            $editClausula = ClausulasAuditorias::find($id);

            $editClausula->update([
                'identificador' => $validatedData['identificador'],
                'nombre_clausulas' => $validatedData['nombre'],
                'descripcion' => $request->descripcion,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Cláusula modificada. La clasificación fue modificada exitosamente.',
                'redirect_url' => route('admin.auditoria-clausula'), // Ruta de redirección
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un problema al modificar la clasificación. Inténtalo nuevamente.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('clausulas_auditorias_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $deleteClausula = ClausulasAuditorias::find($id);
        // dd($deleteClausula);

        if ($deleteClausula && $deleteClausula->delete()) {
            // Redirige con un parámetro de éxito
            return redirect()->route('admin.auditoria-clausula', ['status' => 'success', 'message' => 'Registro eliminado correctamente.']);
        }

        return redirect()->route('admin.auditoria-clausula', ['status' => 'error', 'message' => 'Error al eliminar el registro.']);
    }
}
