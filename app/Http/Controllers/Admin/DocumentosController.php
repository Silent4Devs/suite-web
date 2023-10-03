<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Proceso;
use App\Models\Empleado;
use App\Models\Documento;
use App\Models\Macroproceso;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\VistaDocumento;
use App\Models\RevisionDocumento;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitudAprobacionMail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\HistorialRevisionDocumento;
use App\Models\HistorialVersionesDocumento;
use App\Mail\ConfirmacionSolicitudAprobacionMail;

class DocumentosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('control_documentar_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $documentos = Documento::with('revisor', 'elaborador', 'aprobador', 'responsable', 'revisiones', 'proceso', 'macroproceso')->orderByDesc('id')->get();

        $macroprocesos = Macroproceso::pluck('nombre')->toArray();
        $procesos = Proceso::pluck('nombre')->toArray();
        $macroprocesosAndProcesos = array_merge($macroprocesos, $procesos);

        return view('admin.documentos.index', compact('documentos', 'macroprocesosAndProcesos'));
    }

    public function create()
    {
        abort_if(Gate::denies('control_documentar_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $macroprocesos = Macroproceso::get();
        $procesos = Proceso::getAll();
        $empleados = Empleado::getaltaAll();
        $documentoActual = new Documento;
        $newversdoc = '1';

        return view('admin.documentos.create', compact('macroprocesos', 'procesos', 'empleados', 'documentoActual', 'newversdoc'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('control_documentar_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        if ($request->tipo == 'formato') {
            $request->validate([
                'codigo' => 'required|string|unique:documentos,codigo,NULL,id,deleted_at,NULL',
                'nombre' => 'required|string',
                'tipo' => 'required|string',
                'macroproceso' => 'required_if:tipo,proceso|exists:macroprocesos,id',
                'proceso' => 'required_unless:tipo,proceso|exists:procesos,id',
                'fecha' => 'required|date',
                'archivo' => 'required|mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:10000',
                'elaboro_id' => 'required|exists:empleados,id',
                'aprobo_id' => 'required|exists:empleados,id',
                'reviso_id' => 'required|exists:empleados,id',
                'responsable_id' => 'required|exists:empleados,id',
                'version' => 'required|numeric',
            ], [
                'codigo.unique' => 'El código de documento ya ha sido tomado',
                'archivo.mimetypes' => 'El archivo debe ser de tipo PDF o Word',
            ]);
        } else {
            $request->validate([
                'codigo' => 'required|string|unique:documentos,codigo,NULL,id,deleted_at,NULL',
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
                'version' => 'required|numeric',
            ], [
                'codigo.unique' => 'El código de documento ya ha sido tomado',
                'archivo.mimetypes' => 'El archivo debe ser de tipo PDF',
            ]);
        }
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
            case 'formato':
                $path_documentos_aprobacion .= '/formatos';
                break;
            default:
                $path_documentos_aprobacion .= '/procesos';
                break;
        }
        // $extension = pathinfo($request->file('archivo')->getClientOriginalName(), PATHINFO_EXTENSION);
        // $nombre_original = $request->codigo . '-' . $request->nombre . '-v0';
        // $nombre_compuesto = basename($nombre_original) . '.' . $extension;
        $nombre_compuesto = $request->file('archivo')->getClientOriginalName();
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
            'version' => $request->version,
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
        abort_if(Gate::denies('control_documentar_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $macroprocesos = Macroproceso::get();
        $procesos = Proceso::getAll();
        $empleados = Empleado::getaltaAll();
        $documentoActual = $documento;
        $newversdoc = (intval($documentoActual->version) + 1);

        return view('admin.documentos.edit', compact('macroprocesos', 'procesos', 'empleados', 'documentoActual', 'newversdoc'));
    }

    public function update(Request $request, Documento $documento)
    {
        abort_if(Gate::denies('control_documentar_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $this->validateRequestUpdate($request, $documento);

            return response()->json(['success' => true]);
        } else {
            $this->updateDocument($request, $documento, $documento->estatus);

            return redirect()->route('admin.documentos.index')->with('success', 'Documento editado con éxito');
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
        $validateDocumento = $documento->archivo != null ? 'nullable' : 'required';
        $elaboroId = $documento->elaboro_id != null ? 'nullable' : 'required';
        $revisoId = $documento->reviso_id != null ? 'nullable' : 'required';
        $aproboId = $documento->aprobo_id != null ? 'nullable' : 'required';
        $responsableId = $documento->responsable_id != null ? 'nullable' : 'required';
        $codigoDoc = $documento->codigo != null ? 'nullable' : 'required';
        if ($request->tipo == 'formato') {
            $request->validate([
                'codigo' => $codigoDoc . '|string|unique:documentos,codigo,' . $documento->id . ',id,deleted_at,NULL',
                'nombre' => 'required|string',
                'tipo' => 'required|string',
                'macroproceso' => 'required_if:tipo,proceso|exists:macroprocesos,id',
                'proceso' => 'required_unless:tipo,proceso|exists:procesos,id',
                'fecha' => 'required|date',
                'archivo' => $validateDocumento . '|mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:10000',
                'elaboro_id' => $elaboroId . '|exists:empleados,id',
                'aprobo_id' => $revisoId . '|exists:empleados,id',
                'reviso_id' => $aproboId . '|exists:empleados,id',
                'responsable_id' => $responsableId . '|exists:empleados,id',
                'version' => 'required|numeric',
            ], [
                'codigo.unique' => 'El código de documento ya ha sido tomado',
                'archivo.mimetypes' => 'El archivo debe ser de tipo PDF o Word',
            ]);
        } else {
            $request->validate([
                'codigo' => $codigoDoc . '|string|unique:documentos,codigo,' . $documento->id . ',id,deleted_at,NULL',
                'nombre' => 'required|string',
                'tipo' => 'required|string',
                'macroproceso' => 'required_if:tipo,proceso|exists:macroprocesos,id',
                'proceso' => 'required_unless:tipo,proceso|exists:procesos,id',
                'fecha' => 'required|date',
                'archivo' => $validateDocumento . '|mimetypes:application/pdf|max:10000',
                'elaboro_id' => $elaboroId . '|exists:empleados,id',
                'aprobo_id' => $revisoId . '|exists:empleados,id',
                'reviso_id' => $aproboId . '|exists:empleados,id',
                'responsable_id' => $responsableId . '|exists:empleados,id',
                'version' => 'required|numeric',
            ], [
                'codigo.unique' => 'El código de documento ya ha sido tomado',
                'archivo.mimetypes' => 'El archivo debe ser de tipo PDF',
            ]);
        }
    }

    public function updateDocument(Request $request, Documento $documento, $estatus)
    {
        $this->validateRequestUpdate($request, $documento);
        $this->createDocumentosEnAprobacionIfNotExists();
        $path_documentos_aprobacion = $this->pathDocumentsWhenUpdate($request->tipo);
        $nombre_compuesto = $documento->archivo;
        $version = $request->version;
        if ($estatus != Documento::EN_ELABORACION) {
            $version = $request->version;
        }
        if ($request->file('archivo')) {
            // $extension = pathinfo($request->file('archivo')->getClientOriginalName(), PATHINFO_EXTENSION);
            // $nombre_original = $documento->codigo . '-' . $request->nombre . '-v' . $version;
            // $nombre_compuesto = basename($nombre_original) . '.' . $extension;
            $nombre_compuesto = $request->file('archivo')->getClientOriginalName();
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
            case 'formato':
                $path_documentos_aprobacion .= '/formatos';
                break;
            default:
                $path_documentos_aprobacion .= '/procesos';
                break;
        }

        return $path_documentos_aprobacion;
    }

    public function destroy(Request $request, Documento $documento)
    {
        abort_if(Gate::denies('control_documentar_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            if ($documento->tipo == 'proceso') {
                // logica para eliminar el proceso vinculado al documento
                $proceso = Proceso::where('documento_id', intval($documento->id))->first();
                $revision = RevisionDocumento::where('documento_id', intval($documento->id))->first();
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
                $revision->delete();
            } else {
                $revision = RevisionDocumento::where('documento_id', intval($documento->id))->first();
                $revision->delete();
            }
            $path_documento = $this->getPathDocumento($documento, 'public');
            $extension = pathinfo($path_documento . '/' . $documento->archivo, PATHINFO_EXTENSION);
            $nombre_documento = $documento->codigo . '-' . $documento->nombre . '-obsoleto' . '.' . $extension;

            $ruta_documento = $path_documento . '/' . $documento->archivo;
            $ruta_obsoleto = $this->getPublicPathObsoleteDocument($documento) . '/' . $nombre_documento;

            if (Storage::exists($ruta_documento)) {
                if (Storage::exists($ruta_obsoleto)) {
                    Storage::delete($ruta_obsoleto);
                }
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
            Mail::to(removeUnicodeCharacters($documento->elaborador->email))->send(new ConfirmacionSolicitudAprobacionMail($documento));
            $numero_revision = RevisionDocumento::where('documento_id', $documento_id)->max('no_revision') ? intval(RevisionDocumento::where('documento_id', $documento_id)->max('no_revision')) + 1 : 1;

            $historialRevisionDocumento = HistorialRevisionDocumento::create([
                'documento_id' => $documento_id,
                'descripcion' => $datos['descripcion'],
                'comentarios' => $datos['comentarios'],
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
                    Mail::to(removeUnicodeCharacters($revisor->empleado->email))->send(new SolicitudAprobacionMail($documento, $revisor, $historialRevisionDocumento));
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
        $revisiones = RevisionDocumento::with('documento', 'empleado')->where('documento_id', $documento->id)->get();

        return view('admin.documentos.history-reviews', compact('documento', 'revisiones'));
    }

    public function renderViewDocument(Documento $documento)
    {
        $path_documento = $this->getPathDocumento($documento, 'storage');
        $usuario = User::getCurrentUser();
        if ($usuario->empleado) {
            if (!VistaDocumento::where('documento_id', $documento->id)->where('empleado_id', $usuario->empleado->id)->exists()) {
                VistaDocumento::create([
                    'empleado_id' => $usuario->empleado->id,
                    'documento_id' => $documento->id,
                ]);
            }
        }

        $empleados_vistas = VistaDocumento::with('empleados')->where('documento_id', $documento->id)->get();

        return view('admin.documentos.view-document-file', compact('documento', 'path_documento', 'empleados_vistas'));
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
            case 'formato':
                $path_documento .= '/formatos';
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
            case 'formato':
                $path_documento .= '/formatos';
                break;
            default:
                $path_documento .= '/procesos';
                break;
        }

        // dd($path_documento);
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
        if (!Storage::exists('/public/Documentos en aprobacion/formatos')) {
            Storage::makeDirectory('/public/Documentos en aprobacion/formatos', 0775, true);
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
        if (!Storage::exists('/public/Documentos obsoletos/formatos')) {
            Storage::makeDirectory('/public/Documentos obsoletos/formatos', 0775, true);
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
        $versiones = HistorialVersionesDocumento::with('revisor', 'elaborador', 'aprobador', 'responsable')->where('documento_id', $documento->id)->get();

        if (empty($versiones[0]['id'])) {
            $versiones = Documento::with('revisor', 'elaborador', 'aprobador', 'responsable')->where('id', $documento->id)->get();
            // dd($versiones);
            $path_documento = $this->getPathDocumento($documento, 'storage');
            $extension = pathinfo($path_documento . '/' . $documento->archivo, PATHINFO_EXTENSION);

            return view('admin.documentos.versions-document', compact('documento', 'versiones', 'path_documento'));
        }

        // dd($versiones);
        return view('admin.documentos.versions-document', compact('documento', 'versiones'));
    }

    public function publicados()
    {
        $existsOrganizacion = Organizacion::getFirst()->exists();

        if ($existsOrganizacion) {
            $organizacion = Organizacion::getFirst()->empresa;
        } else {
            $organizacion = 'La Organización';
        }
        $macroprocesos = Macroproceso::pluck('nombre')->toArray();
        $procesos = Proceso::pluck('nombre')->toArray();
        $macroprocesosAndProcesos = array_merge($macroprocesos, $procesos);

        $documentos = Documento::where('estatus', Documento::PUBLICADO)->get();
        // $documentos = Documento::get();

        return view('admin.documentos.list-published', compact('documentos', 'organizacion', 'macroprocesosAndProcesos'));
    }
}
