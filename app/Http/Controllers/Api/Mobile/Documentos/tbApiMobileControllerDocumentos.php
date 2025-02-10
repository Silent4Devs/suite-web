<?php

namespace App\Http\Controllers\Api\Mobile\Documentos;

use App\Http\Controllers\Controller;
use App\Mail\DocumentoAprobadoMail;
use App\Mail\DocumentoNoPublicadoMail;
use App\Mail\DocumentoPublicadoMail;
use App\Mail\DocumentoRechazadoMail;
use App\Mail\SolicitudAprobacionMail;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\HistorialRevisionDocumento;
use App\Models\HistorialVersionesDocumento;
use App\Models\Proceso;
use App\Models\RevisionDocumento;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class tbApiMobileControllerDocumentos extends Controller
{
    use ObtenerOrganizacion;

    public function tbFunctionIndexUsuario()
    {
        function encodeSpecialCharacters($url)
        {
            // Encode special characters, excluding /, \, and :
            $url = preg_replace_callback('/[^A-Za-z0-9_\-\.~\/\\\:]/', function ($matches) {
                return rawurlencode($matches[0]);
            }, $url);

            return $url;
        }

        $empleado = User::getCurrentUser()->empleado;

        // Obtener documentos con sus revisiones y empleados relacionados
        // $documentos = Documento::with('revisiones.empleadoMobile')
        //     ->where('estatus', 2)
        //     ->orWhere('estatus', 3)
        //     ->orderByDesc('id')
        //     ->get();

        $documentos = Documento::with('revisiones.empleadoMobile')
            ->where(function ($query) {
                $query->where('estatus', 2)
                    ->orWhere('estatus', 3);
            })
            ->whereHas('revisiones.empleadoMobile', function ($query) use ($empleado) {
                $query->where('id', $empleado->id); // Compara el id de empleadoMobile con tu variable
            })
            ->orderByDesc('id')
            ->get();

        // dd($documentos);
        // Eliminar documentos que no tengan revisores (revisiones vacías)
        $documentos = $documentos->reject(function ($documento) {
            return $documento->revisiones->isEmpty(); // Elimina el documento si no tiene revisiones
        });

        // Iterar sobre los documentos filtrados
        foreach ($documentos as $keyDocumento => $documento) {
            $numero_revision = RevisionDocumento::where('documento_id', $documento->id)
                ->max('no_revision')
                ? intval(RevisionDocumento::where('documento_id', $documento->id)->max('no_revision')) + 1
                : 1;

            // Ocultar campos innecesarios
            $documento->makeHidden(['created_at', 'updated_at', 'deleted_at']);

            foreach ($documento->revisiones as $keyrevision => $revision) {
                if ($revision->empleadoMobile) {
                    // Ruta de imagen del empleado
                    if ($revision->empleadoMobile->foto == null || $revision->empleadoMobile->foto == '0') {
                        $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                    } else {
                        $ruta = asset('storage/empleados/imagenes/'.$revision->empleadoMobile->foto);
                    }

                    // Asignar detalles del empleado
                    $revision->id_empleado = $revision->empleadoMobile->id;
                    $revision->nombre_empleado = $revision->empleadoMobile->name;
                    $revision->ruta_foto = encodeSpecialCharacters($ruta);

                    // Ocultar campos innecesarios en la revisión
                    $revision->makeHidden(['empleadoMobile', 'created_at', 'updated_at', 'deleted_at']);
                    $revision->empleadoMobile->makeHidden([
                        'avatar',
                        'avatar_ruta',
                        'resourceId',
                        'empleados_misma_area',
                        'genero_formateado',
                        'puesto',
                        'declaraciones_responsable',
                        'declaraciones_aprobador',
                        'declaraciones_responsable2022',
                        'declaraciones_aprobador2022',
                        'fecha_ingreso',
                        'saludo',
                        'saludo_completo',
                        'sede',
                        'perfil',
                        'actual_birdthday',
                        'actual_aniversary',
                        'obtener_antiguedad',
                        'empleados_pares',
                        'competencias_asignadas',
                        'objetivos_asignados',
                        'es_supervisor',
                        'fecha_min_timesheet',
                        'area',
                        'supervisor',
                        'area_id',
                        'puesto_id',
                        'foto',
                        'puestoRelacionado',
                    ]);
                }
            }
        }

        return response()->json([
            'documentos' => $documentos,
        ], 200);
    }

    public function aprobar($id) // Request $request
    {
        $empleado = User::getCurrentUser()->empleado;
        $numero_revision = RevisionDocumento::where('documento_id', $id)->max('no_revision') ? intval(RevisionDocumento::where('documento_id', $id)->max('no_revision')) + 1 : 1;
        $documento = RevisionDocumento::where('id', '=', $id)->where('empleado_id', $empleado->id)->where('no_revision', $numero_revision)->first();
        if (! empty($documento)) {
            $documento->update([
                // 'comentarios' => $request->comentarios,
                'estatus' => strval(Documento::APROBADO),
            ]);

            $documentoOriginal = Documento::with('elaborador')->find($documento->documento_id);

            $email = $documentoOriginal->elaborador->email;
            $this->sendMailApprove($email, $documentoOriginal, $documento);
            $this->allLevelSendAnswer($documento->documento_id, $documentoOriginal);
            if ($this->allSendAnswer($documento->documento_id)) {
                $hDocummento = HistorialRevisionDocumento::where('documento_id', '=', $documento->documento_id)->where('estatus', '=', strval(Documento::EN_ELABORACION))->first();
                if ($hDocummento) {
                    $historialDocumento = HistorialRevisionDocumento::find($hDocummento->id);

                    if ($this->containsReject($documento->documento_id)) {
                        $documentoOriginal->update([
                            'estatus' => strval(Documento::DOCUMENTO_RECHAZADO),
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Documento::DOCUMENTO_RECHAZADO),
                        ]);
                    } else {
                        $path_documentos_aprobacion = 'public/Documentos en aprobacion';
                        switch ($documentoOriginal->tipo) {
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

                        $documentoOriginal->update([
                            'estatus' => strval(Documento::PUBLICADO),
                            'version' => ($documentoOriginal->version),
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Documento::PUBLICADO),
                        ]);

                        $this->publishDocumentInFolder($path_documentos_aprobacion.'/'.$documentoOriginal->archivo, $documentoOriginal);

                        HistorialVersionesDocumento::create([
                            'documento_id' => $documentoOriginal->id,
                            'codigo' => $documentoOriginal->codigo,
                            'nombre' => $documentoOriginal->nombre,
                            'tipo' => $documentoOriginal->tipo,
                            'estatus' => $documentoOriginal->estatus,
                            'macroproceso_id' => $documentoOriginal->macroproceso_id,
                            'version' => $documentoOriginal->version,
                            'fecha' => $documentoOriginal->fecha,
                            'archivo' => $documentoOriginal->archivo,
                            'elaboro_id' => $documentoOriginal->elaboro_id,
                            'aprobo_id' => $documentoOriginal->aprobo_id,
                            'reviso_id' => $documentoOriginal->reviso_id,
                            'responsable_id' => $documentoOriginal->responsable_id,
                        ]);

                        $documentoAct = Documento::with('elaborador')->find($documentoOriginal->id);
                        $this->sendMailPublish($documentoAct->elaborador->email, $documentoAct);
                        $proceso = Proceso::where('documento_id', $documentoAct->id)->first();
                        if ($proceso) {
                            $proceso->update([
                                'estatus' => Proceso::ACTIVO,
                            ]);
                        }
                    }
                }
            }

            return response()->json(['approve' => true]);
        } else {
            return response()->json(['approve' => 'No tiene permitido aprobar o rechazar el documento']);
        }
    }

    public function rechazar($id)
    {
        $empleado = User::getCurrentUser()->empleado;
        $numero_revision = RevisionDocumento::where('documento_id', $id)->max('no_revision') ? intval(RevisionDocumento::where('documento_id', $id)->max('no_revision')) + 1 : 1;
        $documento = RevisionDocumento::where('id', '=', $id)->where('empleado_id', $empleado->id)->where('no_revision', $numero_revision)->first();

        if (! empty($documento)) {
            $documento->update([
                // 'comentarios' => $request->comentarios,
                'estatus' => strval(Documento::RECHAZADO),
            ]);

            RevisionDocumento::where('nivel', $documento->nivel)
                ->where('no_revision', $documento->no_revision)
                ->where('documento_id', $documento->documento_id)
                ->update(['estatus' => Documento::RECHAZADO]);

            $documentoOriginal = Documento::with('elaborador')->find($documento->documento_id);

            $email = $documentoOriginal->elaborador->email;

            $this->sendMailReject($email, $documentoOriginal, $documento);
            $this->allLevelSendAnswer($documento->documento_id, $documentoOriginal);
            if ($this->allSendAnswer($documento->documento_id)) {
                $hDocummento = HistorialRevisionDocumento::where('documento_id', '=', $documento->documento_id)->where('estatus', '=', strval(Documento::EN_ELABORACION))->first();
                if ($hDocummento) {
                    $historialDocumento = HistorialRevisionDocumento::find($hDocummento->id);
                    if ($this->containsReject($documento->documento_id)) {
                        $documentoOriginal->update([
                            'estatus' => strval(Documento::DOCUMENTO_RECHAZADO),
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Documento::DOCUMENTO_RECHAZADO),
                        ]);

                        // $documentoActual = Documento::with('elaborador')->find($documento->documento_id);
                        // $this->sendMailNotPublish($documentoActual->elaborador->email, $documentoActual);
                    } else {
                        $path_documentos_aprobacion = 'public/Documentos en aprobacion';
                        switch ($documentoOriginal->tipo) {
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

                        $documentoOriginal->update([
                            'estatus' => strval(Documento::PUBLICADO),
                            'version' => ($documentoOriginal->version),
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Documento::PUBLICADO),
                        ]);

                        $this->publishDocumentInFolder($path_documentos_aprobacion.'/'.$documentoOriginal->archivo, $documentoOriginal);

                        HistorialVersionesDocumento::create([
                            'documento_id' => $documentoOriginal->id,
                            'codigo' => $documentoOriginal->codigo,
                            'nombre' => $documentoOriginal->nombre,
                            'tipo' => $documentoOriginal->tipo,
                            'estatus' => $documentoOriginal->estatus,
                            'macroproceso_id' => $documentoOriginal->macroproceso_id,
                            'version' => $documentoOriginal->version,
                            'fecha' => $documentoOriginal->fecha,
                            'archivo' => $documentoOriginal->archivo,
                            'elaboro_id' => $documentoOriginal->elaboro_id,
                            'aprobo_id' => $documentoOriginal->aprobo_id,
                            'reviso_id' => $documentoOriginal->reviso_id,
                            'responsable_id' => $documentoOriginal->responsable_id,
                        ]);

                        $documentoAct = Documento::with('elaborador')->find($documentoOriginal->id);
                        $this->sendMailPublish($documentoAct->elaborador->email, $documentoAct);
                        $proceso = Proceso::where('documento_id', $documentoAct->id)->first();
                        if ($proceso) {
                            $proceso->update([
                                'estatus' => Proceso::ACTIVO,
                            ]);
                        }
                    }
                }
            }

            return response()->json(['reject' => true]);
        } else {
            return response()->json(['reject' => 'No tiene permitido aprobar o rechazar el documento']);
        }
    }

    public function sendMailApprove($mail, $documento, $revision)
    {
        Mail::to(removeUnicodeCharacters($mail))->queue(new DocumentoAprobadoMail($documento, $revision));
    }

    public function sendMailPublish($mail, $documento)
    {
        Mail::to(removeUnicodeCharacters($mail))->queue(new DocumentoPublicadoMail($documento));
    }

    public function sendMailNotPublish($mail, $documento)
    {
        Mail::to(removeUnicodeCharacters($mail))->queue(new DocumentoNoPublicadoMail($documento));
    }

    public function sendMailReject($mail, $documento, $revision)
    {
        Mail::to(removeUnicodeCharacters($mail))->queue(new DocumentoRechazadoMail($documento, $revision));
    }

    public function allLevelSendAnswer($documento_id, $documento)
    {
        $nivelesArr = [];

        foreach (RevisionDocumento::select('nivel')->where('documento_id', '=', strval($documento_id))->get() as $revision) {
            array_push($nivelesArr, intval($revision->nivel));
        }
        $niveles = array_unique($nivelesArr);
        foreach (collect($niveles)->sort() as $nivel) {
            $revision_actual = intval(RevisionDocumento::where('documento_id', '=', strval($documento_id))->max('no_revision'));
            $revisiones_actuales = RevisionDocumento::where('documento_id', '=', strval($documento_id))->where('nivel', strval($nivel))->where('estatus', strval(Documento::SOLICITUD_REVISION))->exists();
            if ($this->levelContainsReject($documento_id, $nivel)) {
                $revisiones_faltantes = RevisionDocumento::where('documento_id', '=', strval($documento_id))->where('no_revision', strval($revision_actual))->where('estatus', strval(Documento::SOLICITUD_REVISION))->where('nivel', '!=', strval($nivel))->get();
                $hDocummento = HistorialRevisionDocumento::where('documento_id', '=', $documento_id)->where('estatus', '=', strval(Documento::EN_ELABORACION))->first();

                if ($hDocummento) {
                    $historialDocumento = HistorialRevisionDocumento::find($hDocummento->id);
                    if ($revisiones_faltantes) {
                        foreach ($revisiones_faltantes as $revision_faltante) {
                            $revisionD = RevisionDocumento::find($revision_faltante->id);
                            $revisionD->update([
                                'estatus' => strval(Documento::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR),
                            ]);
                        }
                    }
                    $documento->update([
                        'estatus' => strval(Documento::DOCUMENTO_RECHAZADO),
                    ]);

                    $historialDocumento->update([
                        'estatus' => strval(Documento::DOCUMENTO_RECHAZADO),
                    ]);

                    // $documentoActual = Documento::with('elaborador')->find($documento->id);
                    // $this->sendMailNotPublish($documentoActual->elaborador->email, $documentoActual);
                    return;
                }

                return;
            }
            if (! $revisiones_actuales) {
                if ($nivel < intval($this->checkMaxLevel($documento_id))) {
                    $revisiones_act = RevisionDocumento::with('empleado')->where('documento_id', '=', strval($documento_id))->where('nivel', strval($nivel + 1))->where('estatus', '=', strval(Documento::SOLICITUD_REVISION))->get();
                    $historialRevisionDocumento = HistorialRevisionDocumento::where('documento_id', '=', $documento_id)->where('estatus', '=', strval(Documento::SOLICITUD_REVISION))->first();

                    foreach ($revisiones_act as $revisor) {
                        $revisor_documento = RevisionDocumento::find($revisor->id);
                        $this->sendEmailToNextLevel($revisor->empleado->email, $documento, $revisor_documento, $historialRevisionDocumento);
                    }
                }
            }
        }
    }

    public function sendEmailToNextLevel($email, $id_documento, $id_revisor, $id_historialRevisionDocumento)
    {
        $documento = Documento::where('id', $id_documento)->first();
        $revisor = RevisionDocumento::where('id', $id_revisor)->first();
        $historialRevisionDocumento = HistorialRevisionDocumento::where('id', $id_historialRevisionDocumento)->first();
        Mail::to(removeUnicodeCharacters($email))->queue(new SolicitudAprobacionMail($documento, $revisor, $historialRevisionDocumento));
    }

    public function checkMaxLevel($documento_id)
    {
        $nivel_maximo = intval(RevisionDocumento::where('documento_id', '=', strval($documento_id))->max('nivel'));

        return $nivel_maximo;
    }

    public function allSendAnswer($documento_id)
    {
        $revision_actual = intval(RevisionDocumento::where('documento_id', '=', strval($documento_id))->max('no_revision'));
        $revisiones_actuales = RevisionDocumento::where('documento_id', '=', strval($documento_id))->where('no_revision', strval($revision_actual))->where('estatus', strval(Documento::SOLICITUD_REVISION))->exists();
        if ($revisiones_actuales) {
            return false;
        } else {
            return true;
        }
    }

    public function levelContainsReject($documento_id, $nivel)
    {
        $revision_actual = intval(RevisionDocumento::where('documento_id', '=', strval($documento_id))->where('nivel', strval($nivel))->max('no_revision'));

        $revisiones_actuales = RevisionDocumento::where('documento_id', '=', strval($documento_id))->where('nivel', strval($nivel))->where('no_revision', strval($revision_actual))->where('estatus', strval(Documento::RECHAZADO))->exists();
        if ($revisiones_actuales) {
            return true;
        } else {
            return false;
        }
    }

    public function containsReject($documento_id)
    {
        $revision_actual = intval(RevisionDocumento::where('documento_id', '=', strval($documento_id))->max('no_revision'));
        $revisiones_actuales = RevisionDocumento::where('documento_id', '=', strval($documento_id))->where('no_revision', strval($revision_actual))->where('estatus', strval(Documento::RECHAZADO))->exists();
        if ($revisiones_actuales) {
            return true;
        } else {
            return false;
        }
    }

    public function publishDocumentInFolder($path_documento_aprobacion, $id_documento)
    {
        $documento = Documento::where('id', $id_documento)->first();
        $this->createDocumentosPublicadosIfNotExists();
        $path_documentos_publicados = 'public/Documentos publicados';
        switch ($documento->tipo) {
            case 'proceso':
                $path_documentos_publicados .= '/procesos';
                break;
            case 'politica':
                $path_documentos_publicados .= '/politicas';
                break;
            case 'procedimiento':
                $path_documentos_publicados .= '/procedimientos';
                break;
            case 'manual':
                $path_documentos_publicados .= '/manuales';
                break;
            case 'plan':
                $path_documentos_publicados .= '/planes';
                break;
            case 'instructivo':
                $path_documentos_publicados .= '/instructivos';
                break;
            case 'reglamento':
                $path_documentos_publicados .= '/reglamentos';
                break;
            case 'externo':
                $path_documentos_publicados .= '/externos';
                break;
            case 'formato':
                $path_documentos_publicados .= '/formatos';
                break;
            default:
                $path_documentos_publicados .= '/procesos';
                break;
        }

        $extension = pathinfo($path_documentos_publicados.'/'.$documento->archivo, PATHINFO_EXTENSION);
        $nombre_documento = $documento->codigo.'-'.$documento->nombre.'-v'.$documento->version.'-publicado.'.$extension;
        $ruta_publicacion = $path_documentos_publicados.'/'.$nombre_documento;
        $documento->update([
            'archivo' => $nombre_documento,
        ]);
        if (Storage::exists($path_documento_aprobacion)) {
            Storage::move($path_documento_aprobacion, $ruta_publicacion);
        }

        $ruta_publicacion_documento_anterior = $path_documentos_publicados.'/'.$documento->codigo.'-'.$documento->nombre.'-v'.intval($documento->version - 1).'-publicado.'.$extension;

        // dd($ruta_publicacion);
        if ($documento->estatus == strval(Documento::PUBLICADO)) {
            if (Storage::exists($ruta_publicacion_documento_anterior)) {
                $this->moveBeforeVersionOfDirectory($ruta_publicacion_documento_anterior, $documento);
            }
        }
    }

    public function moveBeforeVersionOfDirectory($path_documento_version_anterior, $id_documento)
    {
        $documento = Documento::where('id', $id_documento)->first();
        $this->createDocumentoVersionesAnterioresIfNotExists();
        $path_documentos_versiones_anteriores = 'public/Documento versiones anteriores';
        switch ($documento->tipo) {
            case 'politica':
                $path_documentos_versiones_anteriores .= '/politicas';
                break;
            case 'procedimiento':
                $path_documentos_versiones_anteriores .= '/procedimientos';
                break;
            case 'manual':
                $path_documentos_versiones_anteriores .= '/manuales';
                break;
            case 'plan':
                $path_documentos_versiones_anteriores .= '/planes';
                break;
            case 'instructivo':
                $path_documentos_versiones_anteriores .= '/instructivos';
                break;
            case 'reglamento':
                $path_documentos_versiones_anteriores .= '/reglamentos';
                break;
            case 'externo':
                $path_documentos_versiones_anteriores .= '/externos';
                break;
            case 'proceso':
                $path_documentos_versiones_anteriores .= '/procesos';
                break;
            case 'formato':
                $path_documentos_versiones_anteriores .= '/formatos';
                break;
            default:
                $path_documentos_versiones_anteriores .= '/procesos';
                break;
        }

        $extension = pathinfo($path_documentos_versiones_anteriores.'/'.$documento->archivo, PATHINFO_EXTENSION);

        $nombre_documento = $documento->codigo.'-'.$documento->nombre.'-v'.intval($documento->version - 1).'.'.$extension;
        $ruta_publicacion = $path_documentos_versiones_anteriores.'/'.$nombre_documento;
        if (Storage::exists($path_documento_version_anterior)) {
            Storage::move($path_documento_version_anterior, $ruta_publicacion);
        }
    }

    public function createDocumentosPublicadosIfNotExists()
    {
        if (! Storage::exists('/public/Documentos publicados')) {
            Storage::makeDirectory('/public/Documentos publicados', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/politicas')) {
            Storage::makeDirectory('/public/Documentos publicados/politicas', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/procedimientos')) {
            Storage::makeDirectory('/public/Documentos publicados/procedimientos', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/manuales')) {
            Storage::makeDirectory('/public/Documentos publicados/manuales', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/planes')) {
            Storage::makeDirectory('/public/Documentos publicados/planes', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/instructivos')) {
            Storage::makeDirectory('/public/Documentos publicados/instructivos', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/reglamentos')) {
            Storage::makeDirectory('/public/Documentos publicados/reglamentos', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/externos')) {
            Storage::makeDirectory('/public/Documentos publicados/externos', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/procesos')) {
            Storage::makeDirectory('/public/Documentos publicados/procesos', 0775, true);
        }
        if (! Storage::exists('/public/Documentos publicados/formatos')) {
            Storage::makeDirectory('/public/Documentos publicados/formatos', 0775, true);
        }
    }

    public function createDocumentoVersionesAnterioresIfNotExists()
    {
        if (! Storage::exists('/public/Documento versiones anteriores')) {
            Storage::makeDirectory('/public/Documento versiones anteriores', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/politicas')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/politicas', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/procedimientos')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/procedimientos', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/manuales')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/manuales', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/planes')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/planes', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/instructivos')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/instructivos', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/reglamentos')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/reglamentos', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/externos')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/externos', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/procesos')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/procesos', 0775, true);
        }
        if (! Storage::exists('/public/Documento versiones anteriores/formatos')) {
            Storage::makeDirectory('/public/Documento versiones anteriores/formatos', 0775, true);
        }
    }
}
