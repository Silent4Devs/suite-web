<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TipoDePermiso;
use Gate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TipoAccesoController extends Controller
{
   public function index(Request $request)
   {
    if ($request->ajax()) {
        $query = TipoDePermiso::orderBy('id')->get();
        $table = DataTables::of($query);

        $table->addColumn('placeholder', '&nbsp;');
        $table->addColumn('actions', '&nbsp;');

        $table->editColumn('actions', function ($row) {
            $viewGate = 'tipo-acceso_ver';
            $editGate = 'tipo-acceso_editar';
            $deleteGate = 'tipo-acceso_eliminar';
            $crudRoutePart = 'tipo-acceso';

            return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
        });

        $table->editColumn('nombre', function ($row) {
            return $row->nombre ? $row->nombre : '';
        });

        $table->editColumn('descripcion', function ($row) {
            return $row->descripcion ? $row->descripcion : '';
        });

        $table->rawColumns(['actions', 'placeholder']);

        return $table->make(true);
    }
        return view('admin.tipo-acceso.index');

   }

   public function create(){


    return view('admin.tipo-acceso.create');
   }

   public function store(Request $request){

    $tiposAcceso = TipoDePermiso::create([
        'nombre'=> $request->nombre,
        'slug'=>Str::slug($request->nombre, '-'),
        'descripcion'=> $request->descripcion,

    ]);

    return view('admin.tipo-acceso.index');
   }

   public function update(Request $request, $tiposAcceso)
    {
        $tiposAcceso = TipoDePermiso::find($tiposAcceso);   

        $tiposAcceso->update([
            'nombre'=> $request->nombre,
            'slug'=>Str::slug($request->nombre, '-'),
            'descripcion'=> $request->descripcion,
        ]);
       
        return redirect(route('admin.tipo-acceso.index'));
    }

    public function edit(Request $request, $tiposAcceso)
    {

        $tiposAcceso = TipoDePermiso::find($tiposAcceso);
        

        return view('admin.tipo-acceso.edit', compact('tiposAcceso'));
    }

  
    public function destroy($acceso)
    {
       
        $tiposAcceso = TipoDePermiso::find($acceso);   
        $tiposAcceso ->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');

        // return redirect()->route('admin.contenedores.index')->with('success', 'Eliminado con éxito');
    }



}
