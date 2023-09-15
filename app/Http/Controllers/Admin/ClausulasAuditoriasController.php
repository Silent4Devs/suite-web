<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClausulasAuditorias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        dd('validacion');
        $nuevaClasificacion = new ClausulasAuditorias();
        $nuevaClasificacion->create([
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
    public function edit(ClausulasAuditorias $clausulasAuditorias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClausulasAuditorias $clausulasAuditorias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClausulasAuditorias $clausulasAuditorias)
    {
        //
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = ClausulasAuditorias::orderByDesc('id')->get();
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
