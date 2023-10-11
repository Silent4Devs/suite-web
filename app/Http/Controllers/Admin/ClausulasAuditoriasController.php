<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClausulasAuditorias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\AuditoriaInternasReportes;
use Yajra\DataTables\Facades\DataTables;

class ClausulasAuditoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clausaudit = ClausulasAuditorias::all();
        // dd($clasifaudit);
        return view('admin.clausulasAuditorias.index', compact('clausaudit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.clausulasAuditorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        // dd($id, $request->all());
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
        $deleteClausula = ClausulasAuditorias::find($id);
        // dd($deleteClausula);
        $deleteClausula->delete();
        return redirect(route('admin.auditoria-clausula'));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = ClausulasAuditorias::orderByDesc('id')->get();

            foreach ($query as $cl) {
                $borrado = AuditoriaInternasHallazgos::where('clausula_id', '=', $cl->id)->exists();
                $cl->borrado = $borrado;
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            // $table->editColumn('actions', function ($row) {
            //     $viewGate = 'auditoria_interna_ver';
            //     $editGate = 'auditoria_interna_editar';
            //     $deleteGate = 'auditoria_interna_eliminar';
            //     $crudRoutePart = 'auditoria-internas';

            // return view('partials.datatablesActions', compact(
            // 'viewGate',
            // 'editGate',
            // 'deleteGate',
            // 'crudRoutePart',
            //         'row'
            //     ));
            // });

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
}
