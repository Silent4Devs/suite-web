<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListaDocumentoEmpleado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ListaDocumentosEmpleados extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lista_de_documentos_empleados_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $docs = ListaDocumentoEmpleado::getAll();

        return view('admin.lista_documentos_empleados.index', compact('docs'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('lista_de_documentos_empleados_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $crear_doc = ListaDocumentoEmpleado::create($request->all());

        return back()->with(['success' => 'Documento agregado']);
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('lista_de_documentos_empleados_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $eliminar_doc = ListaDocumentoEmpleado::find($id);

        $eliminar_doc->delete();

        return back()->with(['success' => 'Documento eliminado']);
    }
}
