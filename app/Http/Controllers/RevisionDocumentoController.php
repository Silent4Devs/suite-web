<?php

namespace App\Http\Controllers;

use App\Models\Proceso;
use App\Models\Empleado;
use App\Models\Documento;
use Illuminate\Http\Request;
use App\Models\RevisionDocumento;
use App\Mail\DocumentoAprobadoMail;
use App\Mail\DocumentoPublicadoMail;
use App\Mail\DocumentoRechazadoMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitudAprobacionMail;
use App\Mail\DocumentoNoPublicadoMail;
use Illuminate\Support\Facades\Storage;
use App\Models\HistorialRevisionDocumento;

class RevisionDocumentoController extends Controller
{

    public function edit(RevisionDocumento $revisionDocumento)
    {
        $documento = Documento::find(intval($revisionDocumento->documento_id));
        $path_documentos_aprobacion = 'storage/Documentos en aprobacion';
        switch ($documento->tipo) {
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

        $empleado = Empleado::find(intval($revisionDocumento->empleado_id));

        return view('externos.revisiones.edit', compact('documento', 'empleado', 'path_documentos_aprobacion', 'revisionDocumento'));
    }

    public function approve(Request $request)
    {
        if ($request->ajax()) {
            $documento = RevisionDocumento::where('id', '=', intval($request->revision))->first();

            $documento->update([
                'comentarios' => $request->comentarios,
                'estatus' => strval(Documento::APROBADO),
            ]);
            $documentoOriginal = Documento::find($documento->documento_id);
            $email = $documento->empleado->email;

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

                        $documentoOriginal->update([
                            'estatus' => strval(Documento::PUBLICADO),
                            'version' => ($documentoOriginal->version + 1)
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Documento::PUBLICADO),
                        ]);
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
                            default:
                                $path_documentos_aprobacion .= '/procesos';
                                break;
                        }

                        $this->publishDocumentInFolder($path_documentos_aprobacion . '/' . $documentoOriginal->archivo, $documentoOriginal);
                        $documentoAct = Documento::with('elaborador')->find($documentoOriginal->id);
                        $this->sendMailPublish($documentoAct->elaborador->email, $documentoAct);
                        $proceso=Proceso::where('documento_id',$documentoAct->id)->first();
                        $proceso->update([
                            'estatus'=>Proceso::ACTIVO,
                        ]);
                    }
                }
            };


            return response()->json(['approve' => true]);
        }
    }

    public function reject(Request $request)
    {
        if ($request->ajax()) {
            $documento = RevisionDocumento::where('id', '=', intval($request->revision))->first();

            $documento->update([
                'comentarios' => $request->comentarios,
                'estatus' => strval(Documento::RECHAZADO),
            ]);
            $documentoOriginal = Documento::find($documento->documento_id);

            $email = $documento->empleado->email;
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

                        $documentoOriginal->update([
                            'estatus' => strval(Documento::PUBLICADO),
                            'version' => ($documentoOriginal->version + 1)
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Documento::PUBLICADO),
                        ]);


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
                            default:
                                $path_documentos_aprobacion .= '/procesos';
                                break;
                        }

                        $this->publishDocumentInFolder($path_documentos_aprobacion . '/' . $documentoOriginal->archivo, $documentoOriginal);

                        $documentoAct = Documento::with('elaborador')->find($documentoOriginal->id);
                        $this->sendMailPublish($documentoAct->elaborador->email, $documentoAct);
                        $proceso=Proceso::where('documento_id',$documentoAct->id)->first();
                        $proceso->update([
                            'estatus'=>Proceso::ACTIVO,
                        ]);
                    }
                }
            };
            return response()->json(['reject' => true]);
        }
    }

    public function sendMailApprove($mail, $documento, $revision)
    {
        Mail::to($mail)->send(new DocumentoAprobadoMail($documento, $revision));
    }

    public function sendMailPublish($mail, $documento)
    {
        Mail::to($mail)->send(new DocumentoPublicadoMail($documento));
    }

    public function sendMailNotPublish($mail, $documento)
    {
        Mail::to($mail)->send(new DocumentoNoPublicadoMail($documento));
    }

    public function sendMailReject($mail, $documento, $revision)
    {
        Mail::to($mail)->send(new DocumentoRechazadoMail($documento, $revision));
    }

    public function allLevelSendAnswer($documento_id, $documento)
    {
        $nivelesArr = array();

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
            if (!$revisiones_actuales) {
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

    public function sendEmailToNextLevel($email, Documento $documento, RevisionDocumento $revisor, HistorialRevisionDocumento $historialRevisionDocumento)
    {

        Mail::to($email)->send(new SolicitudAprobacionMail($documento, $revisor, $historialRevisionDocumento));
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

    public function publishDocumentInFolder($path_documento_aprobacion, Documento $documento)
    {
        $path_documentos_publicados = 'public/Documentos publicados';
        switch ($documento->tipo) {
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
            case 'proceso':
                $path_documentos_publicados .= '/procesos';
                break;
            default:
                $path_documentos_publicados .= '/procesos';
                break;
        }

        $extension = pathinfo($path_documentos_publicados . '/' . $documento->archivo, PATHINFO_EXTENSION);
        $nombreDocumento=$documento->nombre . '-APROBADO.' . $extension;
        $ruta_publicacion = $path_documentos_publicados . '/' . $nombreDocumento;


        Storage::copy($path_documento_aprobacion, $ruta_publicacion);
        $documento->update([
            "archivo"=> $nombreDocumento
        ]);
    }
}
