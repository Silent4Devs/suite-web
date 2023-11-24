<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClausulasAuditorias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\AuditoriaInternasReportes;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

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
        //
        abort_if(Gate::denies('clausulas_auditorias_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clausulasAuditorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        abort_if(Gate::denies('clausulas_auditorias_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            "nombre" => "required",
        ]);

        // dd('validacion');
        $nuevaClausulas = new ClausulasAuditorias();
        $nuevaClausulas->create([
            'identificador' => $request->identificador,
            'nombre_clausulas' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect(route('admin.auditoria-clausula'));
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
        $request->validate([
            "nombre" => "required",
        ]);
        // dd('validacion');
        $editClausula = ClausulasAuditorias::find($id);

        $editClausula->update([
            'identificador' => $request->identificador,
            'nombre_clausulas' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect(route('admin.auditoria-clausula'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('clausulas_auditorias_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $deleteClausula = ClausulasAuditorias::find($id);
        // dd($deleteClausula);
        $deleteClausula->delete();
        return redirect(route('admin.auditoria-clausula'));
    }
}
