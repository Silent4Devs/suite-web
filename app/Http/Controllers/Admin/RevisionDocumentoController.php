<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\RevisionDocumento;
use App\Models\User;
use Illuminate\Http\Request;

class RevisionDocumentoController extends Controller
{
    public function archivo()
    {
        $revisiones = RevisionDocumento::with('documento')->where('empleado_id', User::getCurrentUser()->empleado->id)->where('archivado', RevisionDocumento::ARCHIVADO)->get();

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

    public function obtenerDocumentosDeboAprobar()
    {
        $usuario = User::getCurrentUser();
        if ($usuario->empleado) {
            $revisiones = RevisionDocumento::with(['documento' => function ($query) {
                $query->with('revisor', 'macroproceso', 'elaborador', 'aprobador', 'responsable', 'proceso');
            }])->where('empleado_id', $usuario->empleado->id)->where('archivado', RevisionDocumento::NO_ARCHIVADO)->get();

            return $revisiones;
        } else {
            return [];
        }
    }

    public function obtenerDocumentosDeboAprobarArchivo()
    {
        $usuario = User::getCurrentUser();
        if ($usuario->empleado) {
            $revisiones = RevisionDocumento::with(['documento' => function ($query) {
                $query->with('revisor', 'macroproceso', 'elaborador', 'aprobador', 'responsable', 'proceso');
            }])->where('empleado_id', $usuario->empleado->id)->where('archivado', RevisionDocumento::ARCHIVADO)->get();

            return $revisiones;
        } else {
            return [];
        }
    }

    public function obtenerDocumentosMeDebenAprobar()
    {
        $usuario = User::getCurrentUser();
        if ($usuario->empleado) {
            $mis_documentos = Documento::with('macroproceso')->where('elaboro_id', $usuario->empleado->id)->get();

            return $mis_documentos;
        } else {
            return [];
        }
    }

    // public function obtenerDocumentosMeDebenAprobarArchivo()
    // {
    //$usuario = User::getCurrentUser();
    //     if ($usuario->empleado) {
    //         $revisiones = RevisionDocumento::with(['documento' => function ($query) {
    //             $query->with('revisor', 'macroproceso', 'elaborador', 'aprobador', 'responsable', 'proceso');
    //         }])->where('empleado_id', $usuario->empleado->id)->where('archivado', RevisionDocumento::ARCHIVADO)->get();

    //         return $revisiones;
    //     } else {
    //         return [];
    //     }
    // }
}
