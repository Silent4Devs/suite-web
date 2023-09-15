<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClasificacionesAuditorias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ClasificacionesAuditoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clasifaudit = ClasificacionesAuditorias::all();
        // dd($clasifaudit);
        return view('admin.clasificacionAuditorias.index', compact('clasifaudit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.clasificacionAuditorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
        $request->validate([
            "nombre" => "required",
        ]);
        // dd('validacion');
        $nuevaClasificacion = new ClasificacionesAuditorias;
        $nuevaClasificacion->create([
            'identificador' => $request->identificador,
            'nombre_clasificaciones' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect(route('admin.auditoria-clasificacion'));
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
    public function edit(ClasificacionesAuditorias $clasificacionesAuditorias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClasificacionesAuditorias $clasificacionesAuditorias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClasificacionesAuditorias $clasificacionesAuditorias)
    {
        //
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = ClasificacionesAuditorias::orderByDesc('id')->get();
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
}
