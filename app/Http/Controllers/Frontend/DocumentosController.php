<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmacionSolicitudAprobacionMail;
use App\Mail\SolicitudAprobacionMail;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\HistorialRevisionDocumento;
use App\Models\HistorialVersionesDocumento;
use App\Models\Macroproceso;
use App\Models\Proceso;
use App\Models\RevisionDocumento;
use App\Models\VistaDocumento;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('documentos_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $documentos = Documento::with('revisor', 'elaborador', 'aprobador', 'responsable', 'revisiones', 'proceso', 'macroproceso')->orderByDesc('id')->get();

        return view('frontend.documentos.index', compact('documentos'));
    }

    public function create()
    {
        //abort_if(Gate::denies('documentos_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $macroprocesos = Macroproceso::get();
        $procesos = Proceso::getAll();
        $empleados = Empleado::getAll();
        $documentoActual = new Documento;

        return view('frontend.documentos.create', compact('macroprocesos', 'procesos', 'empleados', 'documentoActual'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $this->validateRequestStore($request);

            return response()->json(['success' => true]);
        } else {
            $this->storeDocument($request, Documento::EN_ELABORACION);

            return redirect()->route('documentos.index')->with('success', 'Documento creado con éxito');
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
            'macroproceso' => 'required_if:tipo,proceso|exists:macroprocesos,id',
            'proceso' => 'required_unless:tipo,proceso|exists:procesos,id',
            'fecha' => 'required|date',
            'archivo' => 'required|mimetypes:application/pdf|max:10000',
            'elaboro_id' => 'required|exists:empleados,id',
            'aprobo_id' => 'required|exists:empleados,id',
            'reviso_id' => 'required|exists:empleados,id',
            'responsable_id' => 'required|exists:empleados,id',
        ], [
            'codigo.unique' => 'El código de documento ya ha sido tomado',
            'archivo.mimetypes' => 'El archivo debe ser de tipo PDF',
        ]);
    }

    public function storeDocument(Request $request, $estatus)
    {
        $this->validateRequestStore($request);
        $this->createDocumentosEnAprobacionIfNotExists();
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

        $macroproceso = null;
        if (isset($request->macroproceso)) {
            $macroproceso = $request->macroproceso;
        }

        $proceso = null;
        if (isset($request->proceso)) {
            $proceso = $request->proceso;
        }
        $documento = Documento::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'estatus' => $estatus,
            'macroproceso_id' => $macroproceso,
            'proceso_id' => $proceso,
            'version' => 0,
            'fecha' => $request->fecha,
            'archivo' => $nombre_compuesto,
            'elaboro_id' => $request->elaboro_id,
            'aprobo_id' => $request->aprobo_id,
            'reviso_id' => $request->reviso_id,
            'responsable_id' => $request->responsable_id,
        ]);

        if ($request->tipo == 'proceso') {
            Proceso::create([
                'nombre' => $request->nombre,
                'codigo' => $request->codigo,
                'estatus' => Proceso::NO_ACTIVO,
                'id_macroproceso' => $request->macroproceso,
                'documento_id' => $documento->id,
            ]);
        }

        return $documento;
    }

    public function edit(Documento $documento)
    {
        //abort_if(Gate::denies('documentos_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $macroprocesos = Macroproceso::get();
        $procesos = Proceso::getAll();
        $empleados = Empleado::getAll();
        $documentoActual = $documento;

        return view('frontend.documentos.edit', compact('macroprocesos', 'procesos', 'empleados', 'documentoActual'));
    }

    public function update(Request $request, Documento $documento)
    {
        if ($request->ajax()) {
            $this->validateRequestUpdate($request, $documento);

            return response()->json(['success' => true]);
        } else {
            $this->updateDocument($request, $documento, $documento->estatus);

            return redirect()->route('documentos.index')->with('success', 'Documento editado con éxito');
        }
    }

    public function updateDocumentWhenPublish(Request $request, Documento $documento)
    {
        if ($request->ajax()) {
            $documento = $this->updateDocument($request, $documento, Documento::EN_REVISION);
            $proceso = Proceso::where('documento_id', $documento->id)->first();
            if ($proceso) {
                $proceso->update([
                    'estatus' => Proceso::NO_ACTIVO,
                ]);
            }

            return response()->json(['success' => true, 'documento_id' => $documento->id]);
        }
    }

    public function validateRequestUpdate(Request $request, Documento $documento)
    {
        $request->validate([
            'codigo' => 'required_if:codigo,null|string|unique:documentos,codigo,' . $documento->id,
            'nombre' => 'required|string',
            'tipo' => 'required|string',
            'macroproceso' => 'required_if:tipo,proceso|exists:macroprocesos,id',
            'proceso' => 'required_unless:tipo,proceso|exists:procesos,id',
            'fecha' => 'required|date',
            'archivo' => 'required|mimetypes:application/pdf|max:10000',
            'elaboro_id' => 'required_if:elaboro_id,null|exists:empleados,id',
            'aprobo_id' => 'required_if:aprobo_id,null|exists:empleados,id',
            'reviso_id' => 'required_if:reviso_id,null|exists:empleados,id',
            'responsable_id' => 'required_if:responsable_id,null|exists:empleados,id',
        ], [
            'codigo.unique' => 'El código de documento ya ha sido tomado',
            'archivo.mimetypes' => 'El archivo debe ser de tipo PDF',
        ]);
    }

    public function updateDocument(Request $request, Documento $documento, $estatus)
    {
        $this->validateRequestUpdate($request, $documento);
        $this->createDocumentosEnAprobacionIfNotExists();
        $path_documentos_aprobacion = $this->pathDocumentsWhenUpdate($request->tipo);
        $nombre_compuesto = $documento->archivo;
        $version = $documento->version;
        if ($estatus != Documento::EN_ELABORACION) {
            $version = $documento->version;
        }
        if ($request->file('archivo')) {
            $extension = pathinfo($request->file('archivo')->getClientOriginalName(), PATHINFO_EXTENSION);
            $nombre_original = $documento->codigo . '-' . $request->nombre . '-v' . $version;
            $nombre_compuesto = basename($nombre_original) . '.' . $extension;
            //Se elimina el archivo anterior
            if (Storage::exists($this->pathDocumentsWhenUpdate($documento->tipo) . '/' . $documento->archivo)) {
                Storage::delete([$this->pathDocumentsWhenUpdate($documento->tipo) . '/' . $documento->archivo]);
            }
            //Se guarda el nuevo documento
            $request->file('archivo')->storeAs($path_documentos_aprobacion, $nombre_compuesto); // Almacenar Archivo
        }

        $macroproceso = null;
        if (isset($request->macroproceso)) {
            $macroproceso = $request->macroproceso;
        }

        $proceso = null;
        if (isset($request->proceso)) {
            $proceso = $request->proceso;
        }

        $elaborador = $documento->elaboro_id;
        if (!$documento->elaborador) {
            $elaborador = $request->elaboro_id;
        }

        $aprobador = $documento->aprobo_id;
        if (!$documento->aprobador) {
            $aprobador = $request->aprobo_id;
        }

        $revisor = $documento->reviso_id;
        if (!$documento->revisor) {
            $revisor = $request->reviso_id;
        }
        // dd($revisor);
        $responsable = $documento->responsable_id;
        if (!$documento->responsable) {
            $responsable = $request->responsable_id;
        }

        $documento->update([
            // 'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'estatus' => $estatus,
            'macroproceso_id' => $macroproceso,
            'proceso_id' => $proceso,
            'version' => $version,
            'fecha' => $request->fecha,
            'archivo' => $nombre_compuesto,
            'elaboro_id' => $elaborador,
            'aprobo_id' => $aprobador,
            'reviso_id' => $revisor,
            'responsable_id' => $responsable,
        ]);

        return $documento;
    }

    public function pathDocumentsWhenUpdate($tipo)
    {
        $path_documentos_aprobacion = 'public/Documentos en aprobacion';
        switch ($tipo) {
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

        return $path_documentos_aprobacion;
    }

    public function destroy(Request $request, Documento $documento)
    {
        //abort_if(Gate::denies('documentos_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            if ($documento->tipo == 'proceso') {
                // logica para eliminar el proceso vinculado al documento
                $proceso = Proceso::where('documento_id', intval($documento->id))->first();
                if ($request->delete_documents == 'true') {
                    if ($proceso) {
                        $dependencias = Documento::where('proceso_id', '=', $proceso->id)->get();
                        if ($dependencias) {
                            foreach ($dependencias as $dependencia) {
                                $dependencia->delete();
                            }
                        }
                    }
                }
                if ($proceso) {
                    $proceso->delete();
                }
            }
            $path_documento = $this->getPathDocumento($documento, 'public');
            $extension = pathinfo($path_documento . '/' . $documento->archivo, PATHINFO_EXTENSION);
            $nombre_documento = $documento->codigo . '-' . $documento->nombre . '-obsoleto' . '.' . $extension;

            $ruta_documento = $path_documento . '/' . $documento->archivo;
            $ruta_obsoleto = $this->getPublicPathObsoleteDocument($documento) . '/' . $nombre_documento;

            if (Storage::exists($ruta_documento)) {
                Storage::move($ruta_documento, $ruta_obsoleto);
            }
            $eliminar = $documento->delete();

            if ($eliminar) {
                return response()->json(['success' => true]);
            }
        } catch (QueryException $e) {
            if ($e->errorInfo[0] == '23000') {
                return response()->json(['error' => 'Este registro contiene relación con diversas tablas, eliminarlo trearía problemas de estabilidad en el sistema.']);
            }
        }
    }

    public function doDocumentObsolete(Documento $documento)
    {
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
            $datos = [];
            parse_str($request->datosRevisores, $datos);
            $documento_id = intval($request->documentoCreado);
            $revisores1 = [];
            $documento = Documento::find($documento_id);
            $documento->load('elaborador', 'macroproceso');
            Mail::to($documento->elaborador->email)->send(new ConfirmacionSolicitudAprobacionMail($documento));
            $numero_revision = RevisionDocumento::where('documento_id', $documento_id)->max('no_revision') ? intval(RevisionDocumento::where('documento_id', $documento_id)->max('no_revision')) + 1 : 1;

            $historialRevisionDocumento = HistorialRevisionDocumento::create([
                'documento_id' => $documento_id,
                'descripcion' =>  $datos['descripcion'],
                'comentarios' =>  $datos['comentarios'],
                'version' => $documento->version,
                'fecha' => Carbon::now(),
            ]);

            if (isset($datos['revisores1'])) {
                $revisores1 = $datos['revisores1'];
                foreach ($revisores1 as $revisor_id) {
                    $revisor = RevisionDocumento::create([
                        'empleado_id' => $revisor_id,
                        'nivel' => 1,
                        'no_revision' => strval($numero_revision),
                        'documento_id' => $documento_id,
                        'version' => $documento->version,
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
                        'version' => $documento->version,
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
                        'version' => $documento->version,
                    ]);
                }
            }

            return response()->json(['data' => $documento]);
        }
    }

    public function renderHistoryReview(Documento $documento)
    {
        //abort_if(Gate::denies('documentos_history_reviews'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $revisiones = RevisionDocumento::with('documento', 'empleado')->where('documento_id', $documento->id)->get();

        return view('frontend.documentos.history-reviews', compact('documento', 'revisiones'));
    }

    public function renderViewDocument(Documento $documento)
    {
        //abort_if(Gate::denies('documentos_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $path_documento = $this->getPathDocumento($documento, 'storage');

        if (auth()->user()->empleado) {
            if (!VistaDocumento::where('documento_id', $documento->id)->where('empleado_id', auth()->user()->empleado->id)->exists()) {
                VistaDocumento::create([
                    'empleado_id' => auth()->user()->empleado->id,
                    'documento_id' => $documento->id,
                ]);
            }
        }

        $empleados_vistas = VistaDocumento::with('empleados')->where('documento_id', $documento->id)->get();

        return view('frontend.documentos.view-document-file', compact('documento', 'path_documento', 'empleados_vistas'));
    }

    public function getPublicPathObsoleteDocument(Documento $documento)
    {
        $this->createDocumentosObsoletosIfNotExists();
        $path_documento = 'public/Documentos obsoletos';
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

        return $path_documento;
    }

    public function getPathDocumento(Documento $documento, $ruta)
    {
        $path_documento = $ruta . '/Documentos en aprobacion';

        if ($documento->estatus == strval(Documento::PUBLICADO)) {
            $path_documento = $ruta . '/Documentos publicados';
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

        return $path_documento;
    }

    public function createDocumentosEnAprobacionIfNotExists()
    {
        if (!Storage::exists('/public/Documentos en aprobacion')) {
            Storage::makeDirectory('/public/Documentos en aprobacion', 0775, true);
        }
        if (!Storage::exists('/public/Documentos en aprobacion/politicas')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/politicas', 0775, true);
        }
        if (!Storage::exists('/public/Documentos en aprobacion/procedimientos')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/procedimientos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos en aprobacion/manuales')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/manuales', 0775, true);
        }
        if (!Storage::exists('/public/Documentos en aprobacion/planes')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/planes', 0775, true);
        }
        if (!Storage::exists('/public/Documentos en aprobacion/instructivos')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/instructivos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos en aprobacion/reglamentos')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/reglamentos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos en aprobacion/externos')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/externos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos en aprobacion/procesos')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/procesos', 0775, true);
        }
    }

    public function createDocumentosObsoletosIfNotExists()
    {
        if (!Storage::exists('/public/Documentos obsoletos')) {
            Storage::makeDirectory('/public/Documentos obsoletos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos obsoletos/politicas')) {
            Storage::makeDirectory('/public/Documentos obsoletos/politicas', 0775, true);
        }
        if (!Storage::exists('/public/Documentos obsoletos/procedimientos')) {
            Storage::makeDirectory('/public/Documentos obsoletos/procedimientos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos obsoletos/manuales')) {
            Storage::makeDirectory('/public/Documentos obsoletos/manuales', 0775, true);
        }
        if (!Storage::exists('/public/Documentos obsoletos/planes')) {
            Storage::makeDirectory('/public/Documentos obsoletos/planes', 0775, true);
        }
        if (!Storage::exists('/public/Documentos obsoletos/instructivos')) {
            Storage::makeDirectory('/public/Documentos obsoletos/instructivos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos obsoletos/reglamentos')) {
            Storage::makeDirectory('/public/Documentos obsoletos/reglamentos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos obsoletos/externos')) {
            Storage::makeDirectory('/public/Documentos obsoletos/externos', 0775, true);
        }
        if (!Storage::exists('/public/Documentos obsoletos/procesos')) {
            Storage::makeDirectory('/public/Documentos obsoletos/procesos', 0775, true);
        }
    }

    public function getDocumentDependencies(Request $request)
    {
        $proceso = Proceso::where('documento_id', intval($request->documento_id))->first();
        if ($proceso) {
            $dependencias = Documento::where('proceso_id', '=', $proceso->id)->get();

            return response()->json(['dependencias' => $dependencias]);
        } else {
            return response()->json(['dependencias' => null]);
        }
    }

    public function renderHistoryVersions(Documento $documento)
    {
        //abort_if(Gate::denies('documentos_versiones'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $versiones = HistorialVersionesDocumento::with('revisor', 'elaborador', 'aprobador', 'responsable')->where('documento_id', $documento->id)->get();

        return view('frontend.documentos.versions-document', compact('documento', 'versiones'));
    }

    public function publicados()
    {
        $documentos = Documento::where('estatus', Documento::PUBLICADO)->get();

        return view('frontend.documentos.list-published', compact('documentos'));
    }
}
