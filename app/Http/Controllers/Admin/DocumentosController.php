<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmacionSolicitudAprobacionMail;
use App\Mail\SolicitudAprobacionMail;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\HistorialRevisionDocumento;
use App\Models\Macroproceso;
use App\Models\RevisionDocumento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DocumentosController extends Controller
{
    public function index()
    {

        $documentos = Documento::with('revisor', 'elaborador', 'aprobador', 'responsable', 'revisiones')->get();

        return view('admin.documentos.index', compact('documentos'));
    }

    public function create()
    {
        $macroprocesos = Macroproceso::get();
        $empleados = Empleado::get();
        $documentoActual = new Documento;
        return view('admin.documentos.create', compact('macroprocesos', 'empleados', 'documentoActual'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $this->validateRequestStore($request);
            return response()->json(['success' => true]);
        } else {
            $this->storeDocument($request, Documento::EN_ELABORACION);
            return redirect()->route('admin.documentos.index')->with('success', 'Documento creado con éxito');
        }
    }

    public function storeDocumentWhenPublish(Request $request)
    {
        if ($request->ajax()) {
            $documento = $this->storeDocument($request, Documento::EN_REVISION);
            return response()->json(['success' => true, 'documento_id' => $documento->id]);
        }
    }

    public function validateRequestStore(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|unique:documentos',
            'nombre' => 'required|string',
            'tipo' => 'required|string',
            // 'estatus' => 'required|string',
            'macroproceso' => 'required|exists:macroprocesos,id',
            //'version' => 'required|string',
            'fecha' => 'required|date',
            'archivo' => 'required|mimetypes:application/pdf|max:10000',
            'elaboro_id' => 'required|exists:empleados,id',
            'aprobo_id' => 'required|exists:empleados,id',
            'reviso_id' => 'required|exists:empleados,id',
            'responsable_id' => 'required|exists:empleados,id'
        ], [
            'codigo.unique' => 'El código de documento ya ha sido tomado',
            'archivo.mimetypes' => 'El archivo debe ser de tipo PDF'
        ]);
    }

    public function storeDocument(Request $request, $estatus)
    {
        $this->validateRequestStore($request);
        $path_documentos_aprobacion = 'public/Documentos en aprobacion';
        switch ($request->tipo) {
            case 'politica':
                $path_documentos_aprobacion .= '/politicas';
                break;
            case 'procedimiento':
                $path_documentos_aprobacion .= '/procedimientos';
                break;
            case 'manual':
                $path_documentos_aprobacion .= '/manuales';
                break;
            case 'plan':
                $path_documentos_aprobacion .= '/planes';
                break;
            case 'instructivo':
                $path_documentos_aprobacion .= '/instructivos';
                break;
            case 'reglamento':
                $path_documentos_aprobacion .= '/reglamentos';
                break;
            case 'externo':
                $path_documentos_aprobacion .= '/externos';
                break;
            case 'proceso':
                $path_documentos_aprobacion .= '/procesos';
                break;
            default:
                $path_documentos_aprobacion .= '/procesos';
                break;
        }
        $extension = pathinfo($request->file('archivo')->getClientOriginalName(), PATHINFO_EXTENSION);
        $nombre_original = $request->codigo . '-' . $request->nombre . '-v0';
        $nombre_compuesto = basename($nombre_original) . '.' . $extension;
        $request->file('archivo')->storeAs($path_documentos_aprobacion, $nombre_compuesto); // Almacenar Archivo

        $documento = Documento::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'estatus' => $estatus,
            'macroproceso_id' => $request->macroproceso,
            'version' => 0,
            'fecha' => $request->fecha,
            'archivo' => $nombre_compuesto,
            'elaboro_id' => $request->elaboro_id,
            'aprobo_id' => $request->aprobo_id,
            'reviso_id' => $request->reviso_id,
            'responsable_id' => $request->responsable_id
        ]);

        return $documento;
    }

    public function show(Documento $documento)
    {
        //
    }

    public function edit(Documento $documento)
    {
        $macroprocesos = Macroproceso::get();
        $empleados = Empleado::get();
        $documentoActual = $documento;

        return view('admin.documentos.edit', compact('macroprocesos', 'empleados', 'documentoActual'));
    }

    public function update(Request $request, Documento $documento)
    {
        if ($request->ajax()) {
            $this->validateRequestUpdate($request, $documento);
            return response()->json(['success' => true]);
        } else {
            $this->updateDocument($request, $documento, Documento::EN_ELABORACION);
            return redirect()->route('admin.documentos.index')->with('success', 'Documento editado con éxito');
        }
    }

    public function updateDocumentWhenPublish(Request $request, Documento $documento)
    {
        if ($request->ajax()) {
            $documento = $this->updateDocument($request, $documento, Documento::EN_REVISION);
            return response()->json(['success' => true, 'documento_id' => $documento->id]);
        }
    }

    public function validateRequestUpdate(Request $request, Documento $documento)
    {
        $request->validate([
            'codigo' => 'required_if:codigo,null|string|unique:documentos,codigo,' . $documento->id,
            'nombre' => 'required|string',
            'tipo' => 'required|string',
            //'estatus' => 'required|string',
            'macroproceso' => 'required|exists:macroprocesos,id',
            //'version' => 'required|string',
            'fecha' => 'required|date',
            'archivo' => 'required|mimetypes:application/pdf|max:10000',
            'elaboro_id' => 'required_if:elaboro_id,null|exists:empleados,id',
            'aprobo_id' => 'required_if:aprobo_id,null|exists:empleados,id',
            'reviso_id' => 'required_if:reviso_id,null|exists:empleados,id',
            'responsable_id' => 'required_if:responsable_id,null|exists:empleados,id'
        ], [
            'codigo.unique' => 'El código de documento ya ha sido tomado',
            'archivo.mimetypes' => 'El archivo debe ser de tipo PDF'
        ]);
    }

    public function updateDocument(Request $request, Documento $documento, $estatus)
    {
        $this->validateRequestUpdate($request, $documento);
        $path_documentos_aprobacion = 'public/Documentos en aprobacion';
        switch ($request->tipo) {
            case 'politica':
                $path_documentos_aprobacion .= '/politicas';
                break;
            case 'procedimiento':
                $path_documentos_aprobacion .= '/procedimientos';
                break;
            case 'manual':
                $path_documentos_aprobacion .= '/manuales';
                break;
            case 'plan':
                $path_documentos_aprobacion .= '/planes';
                break;
            case 'instructivo':
                $path_documentos_aprobacion .= '/instructivos';
                break;
            case 'reglamento':
                $path_documentos_aprobacion .= '/reglamentos';
                break;
            case 'externo':
                $path_documentos_aprobacion .= '/externos';
                break;
            case 'proceso':
                $path_documentos_aprobacion .= '/procesos';
                break;
            default:
                $path_documentos_aprobacion .= '/procesos';
                break;
        }
        $nombre_compuesto = $documento->archivo;
        $version = $documento->version;
        if ($estatus != Documento::EN_ELABORACION) {
            $version = $documento->version;
        }
        if ($request->file('archivo')) {
            $extension = pathinfo($request->file('archivo')->getClientOriginalName(), PATHINFO_EXTENSION);
            $nombre_original = $documento->codigo . '-' . $request->nombre . '-v' . $version;
            $nombre_compuesto = basename($nombre_original) . '.' . $extension;
            $request->file('archivo')->storeAs($path_documentos_aprobacion, $nombre_compuesto); // Almacenar Archivo
        }
        // $estatus = $documento->estatus;


        $documento->update([
            // 'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'estatus' => $estatus,
            'macroproceso_id' => $request->macroproceso,
            'version' => $version,
            'fecha' => $request->fecha,
            'archivo' => $nombre_compuesto,
            'elaboro_id' => $documento->elaboro_id,
            'aprobo_id' => $documento->aprobo_id,
            'reviso_id' => $documento->reviso_id,
            'responsable_id' => $documento->responsable_id
        ]);

        return $documento;
    }


    public function destroy(Documento $documento)
    {
        //
    }

    public function checkCode(Request $request)
    {
        if ($request->ajax()) {
            $codigo = $request->codigo;
            $documentoExists = Documento::where('codigo', '=', $codigo)->exists();
            if ($documentoExists) {
                return response()->json(['exists' => true]);
            } else {
                return response()->json(['exists' => false]);
            }
        }
    }

    public function publish(Request $request)
    {
        if ($request->ajax()) {
            $datos = array();
            parse_str($request->datosRevisores, $datos);
            $documento_id = intval($request->documentoCreado);
            $revisores1 = array();
            $documento = Documento::find($documento_id);
            $documento->load('elaborador', 'macroproceso');
            Mail::to($documento->elaborador->email)->send(new ConfirmacionSolicitudAprobacionMail($documento));
            $numero_revision = RevisionDocumento::where('documento_id', $documento_id)->max('no_revision') ? intval(RevisionDocumento::where('documento_id', $documento_id)->max('no_revision')) + 1 : 1;

            $historialRevisionDocumento = HistorialRevisionDocumento::create([
                'documento_id' => $documento_id,
                'descripcion' =>  $datos['descripcion'],
                'comentarios' =>  $datos['comentarios'],
                'version' => $documento->version,
                'fecha' => Carbon::now()
            ]);

            if (isset($datos['revisores1'])) {
                $revisores1 = $datos['revisores1'];
                foreach ($revisores1 as $revisor_id) {
                    $revisor = RevisionDocumento::create([
                        'empleado_id' => $revisor_id,
                        'nivel' => 1,
                        'no_revision' => strval($numero_revision),
                        'documento_id' => $documento_id,
                        'version' => $documento->version
                    ]);
                    Mail::to($revisor->empleado->email)->send(new SolicitudAprobacionMail($documento, $revisor, $historialRevisionDocumento));
                }
            }

            if (isset($datos['revisores2'])) {
                $revisores2 = $datos['revisores2'];
                foreach ($revisores2 as $revisor_id) {
                    RevisionDocumento::create([
                        'empleado_id' => $revisor_id,
                        'nivel' => 2,
                        'no_revision' => strval($numero_revision),
                        'documento_id' => $documento_id,
                        'version' => $documento->version
                    ]);
                }
            }
            if (isset($datos['revisores3'])) {
                $revisores3 = $datos['revisores3'];
                foreach ($revisores3 as $revisor_id) {
                    RevisionDocumento::create([
                        'empleado_id' => $revisor_id,
                        'nivel' => 3,
                        'no_revision' => strval($numero_revision),
                        'documento_id' => $documento_id,
                        'version' => $documento->version
                    ]);
                }
            }

            return response()->json(['data' => $documento]);
        }
    }

    public function renderHistoryReview(Documento $documento)
    {
        $revisiones = RevisionDocumento::with('documento', 'empleado')->where('documento_id', $documento->id)->get();

        return view('admin.documentos.history-reviews', compact('documento', 'revisiones'));
    }

    public function renderViewDocument(Documento $documento)
    {
        $path_documento = 'storage/Documentos en aprobacion';
        if ($documento->estatus == strval(Documento::PUBLICADO)) {
            $path_documento = 'storage/Documentos publicados';
        }

        switch ($documento->tipo) {
            case 'politica':
                $path_documento .= '/politicas';
                break;
            case 'procedimiento':
                $path_documento .= '/procedimientos';
                break;
            case 'manual':
                $path_documento .= '/manuales';
                break;
            case 'plan':
                $path_documento .= '/planes';
                break;
            case 'instructivo':
                $path_documento .= '/instructivos';
                break;
            case 'reglamento':
                $path_documento .= '/reglamentos';
                break;
            case 'externo':
                $path_documento .= '/externos';
                break;
            case 'proceso':
                $path_documento .= '/procesos';
                break;
            default:
                $path_documento .= '/procesos';
                break;
        }
        return view('admin.documentos.view-document-file', compact('documento', 'path_documento'));
    }
}
