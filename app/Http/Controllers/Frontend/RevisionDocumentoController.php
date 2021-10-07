<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RevisionDocumento;
use Illuminate\Http\Request;

class RevisionDocumentoController extends Controller
{
    public function archivo()
    {
        $revisiones = RevisionDocumento::with('documento')->where('empleado_id', auth()->user()->empleado->id)->where('archivado', RevisionDocumento::ARCHIVADO)->get();

        return view('admin.revisiones.archivo', compact('revisiones'));
    }

    public function archivar(Request $request)
    {
        if ($request->ajax()) {
            $revision = RevisionDocumento::find($request->revision_id);
            $revision->update([
                'archivado' => RevisionDocumento::ARCHIVADO,
            ]);
            if ($revision) {
                return response()->json(['archivado' => true]);
            } else {
                return response()->json(['archivado' => false]);
            }
        }
    }

    public function desarchivar(Request $request)
    {
        if ($request->ajax()) {
            $revision = RevisionDocumento::find($request->revision_id);
            $revision->update([
                'archivado' => RevisionDocumento::NO_ARCHIVADO,
            ]);
            if ($revision) {
                return response()->json(['desarchivado' => true]);
            } else {
                return response()->json(['desarchivado' => false]);
            }
        }
    }
}
