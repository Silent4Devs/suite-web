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
        // dd($request->nombre);
        $request->validate([
            "nombre" => "required",
        ]);
        // dd('validacion');
        $nuevaClasificacion = ClasificacionesAuditorias::create([
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
    public function edit($id)
    {
        //
        $clasif = ClasificacionesAuditorias::find($id);
        // dd($clasif);
        return view('admin.clasificacionAuditorias.edit', compact('clasif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        // dd($id, $request->all());
        $request->validate([
            "nombre" => "required",
        ]);
        // dd('validacion');
        $editClasificacion = ClasificacionesAuditorias::find($id);

        $editClasificacion->update([
            'identificador' => $request->identificador,
            'nombre_clasificaciones' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect(route('admin.auditoria-clasificacion'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $deleteClasificacion = ClasificacionesAuditorias::find($id);
        // dd($deleteClasificacion);
        $deleteClasificacion->delete();
        return redirect(route('admin.auditoria-clasificacion'));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = ClasificacionesAuditorias::orderByDesc('id')->get();

            foreach ($query as $cf) {
                $borrado = $cf->existencia() ? 'false' : 'true';
                $cf->borrado = $borrado;
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
