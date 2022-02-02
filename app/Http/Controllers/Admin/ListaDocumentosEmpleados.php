<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListaDocumentoEmpleado;

class ListaDocumentosEmpleados extends Controller
{
    public function index()
    {
        $docs = ListaDocumentoEmpleado::get();
        return view('admin.lista_documentos_empleados.index', compact('docs'));
    }

    public function store(Request $request)
    {
        $crear_doc = ListaDocumentoEmpleado::create($request->all());

        return back()->with(['success'=>'Documento agregado']); 
    }

    public function destroy($id)
    {
        $eliminar_doc = ListaDocumentoEmpleado::find($id);

        $eliminar_doc->delete();

        return back()->with(['success'=>'Documento eliminado']); 
    }
}
