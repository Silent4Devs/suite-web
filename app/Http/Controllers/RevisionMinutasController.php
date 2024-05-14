<?php

namespace App\Http\Controllers;

use App\Mail\Minutas\MinutaAprobada;
use App\Mail\Minutas\MinutaConfirmacionAprobacion;
use App\Mail\Minutas\MinutaConfirmacionRechazo;
use App\Mail\Minutas\MinutaRechazada;
use App\Models\Empleado;
use App\Models\HistoralRevisionMinuta;
use App\Models\Minutasaltadireccion;
use App\Models\RevisionMinuta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RevisionMinutasController extends Controller
{
    public function edit(RevisionMinuta $revisionMinuta)
    {
        $minuta = Minutasaltadireccion::find(intval($revisionMinuta->minuta_id));
        if (! $minuta) {
            abort_if(! $minuta, 404);
        }
        $empleado = Empleado::alta()->find(intval($revisionMinuta->empleado_id));

        return view('externos.minutas.revisiones.edit', compact('minuta', 'empleado', 'revisionMinuta'));
    }

    public function approve(Request $request)
    {
        if ($request->ajax()) {
            $revisionMinuta = RevisionMinuta::where('id', '=', intval($request->revision))->first();

            $revisionMinuta->update([
                'comentarios' => $request->comentarios,
                'estatus' => strval(RevisionMinuta::APROBADO),
            ]);
            $minutaOriginal = Minutasaltadireccion::find($revisionMinuta->minuta_id);
            $email = $revisionMinuta->empleado->email;

            $this->sendMailApprove($email, $minutaOriginal, $revisionMinuta);
            $this->allLevelSendAnswer($revisionMinuta->minuta_id, $minutaOriginal);
            if ($this->allSendAnswer($revisionMinuta->minuta_id)) {
                $hDocummento = HistoralRevisionMinuta::where('minuta_id', '=', $revisionMinuta->minuta_id)->where('estatus', '=', strval(Minutasaltadireccion::EN_ELABORACION))->first();
                if ($hDocummento) {
                    $historialDocumento = HistoralRevisionMinuta::find($hDocummento->id);

                    if ($this->containsReject($revisionMinuta->minuta_id)) {
                        $minutaOriginal->update([
                            'estatus' => strval(Minutasaltadireccion::DOCUMENTO_RECHAZADO),
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Minutasaltadireccion::DOCUMENTO_RECHAZADO),
                        ]);
                    } else {
                        $path_documento_aprobacion = 'public/minutas/en aprobacion/'.$minutaOriginal->documento;
                        $ruta_publicacion = 'public/minutas/aprobadas/'.$minutaOriginal->documento;
                        $minutaOriginal->update([
                            'estatus' => strval(Minutasaltadireccion::PUBLICADO),
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Minutasaltadireccion::PUBLICADO),
                        ]);

                        if (Storage::exists($path_documento_aprobacion)) {
                            Storage::move($path_documento_aprobacion, $ruta_publicacion);
                        }

                        $documentoAct = Minutasaltadireccion::with('responsable')->find($minutaOriginal->id);
                        $this->sendMailPublish($documentoAct->responsable->email, $documentoAct);
                    }
                }
            }

            return response()->json(['approve' => true]);
        }
    }

    public function allSendAnswer($minuta_id)
    {
        $revision_actual = intval(RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->max('no_revision'));
        $revisiones_actuales = RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->where('no_revision', strval($revision_actual))->where('estatus', strval(RevisionMinuta::SOLICITUD_REVISION))->exists();
        if ($revisiones_actuales) {
            return false;
        } else {
            return true;
        }
    }

    public function allLevelSendAnswer($minuta_id, $minuta)
    {
        $nivelesArr = [];

        foreach (RevisionMinuta::select('nivel')->where('minuta_id', '=', strval($minuta_id))->get() as $revision) {
            array_push($nivelesArr, intval($revision->nivel));
        }
        $niveles = array_unique($nivelesArr);
        foreach (collect($niveles)->sort() as $nivel) {
            $revision_actual = intval(RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->max('no_revision'));
            $revisiones_actuales = RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->where('nivel', strval($nivel))->where('estatus', strval(RevisionMinuta::SOLICITUD_REVISION))->exists();
            if ($this->levelContainsReject($minuta_id, $nivel)) {
                $revisiones_faltantes = RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->where('no_revision', strval($revision_actual))->where('estatus', strval(RevisionMinuta::SOLICITUD_REVISION))->where('nivel', '!=', strval($nivel))->get();
                $hDocummento = HistoralRevisionMinuta::where('minuta_id', '=', $minuta_id)->where('estatus', '=', strval(Minutasaltadireccion::EN_ELABORACION))->first();

                if ($hDocummento) {
                    $historialDocumento = HistoralRevisionMinuta::find($hDocummento->id);
                    if ($revisiones_faltantes) {
                        foreach ($revisiones_faltantes as $revision_faltante) {
                            $revisionD = RevisionMinuta::find($revision_faltante->id);
                            $revisionD->update([
                                'estatus' => strval(RevisionMinuta::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR),
                            ]);
                        }
                    }
                    $minuta->update([
                        'estatus' => strval(Minutasaltadireccion::DOCUMENTO_RECHAZADO),
                    ]);

                    $historialDocumento->update([
                        'estatus' => strval(Minutasaltadireccion::DOCUMENTO_RECHAZADO),
                    ]);

                    return;
                }

                return;
            }
        }
    }

    public function levelContainsReject($minuta_id, $nivel)
    {
        $revision_actual = intval(RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->where('nivel', strval($nivel))->max('no_revision'));

        $revisiones_actuales = RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->where('nivel', strval($nivel))->where('no_revision', strval($revision_actual))->where('estatus', strval(RevisionMinuta::RECHAZADO))->exists();
        if ($revisiones_actuales) {
            return true;
        } else {
            return false;
        }
    }

    public function containsReject($minuta_id)
    {
        $revision_actual = intval(RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->max('no_revision'));
        $revisiones_actuales = RevisionMinuta::where('minuta_id', '=', strval($minuta_id))->where('no_revision', strval($revision_actual))->where('estatus', strval(RevisionMinuta::RECHAZADO))->exists();
        if ($revisiones_actuales) {
            return true;
        } else {
            return false;
        }
    }

    public function reject(Request $request)
    {
        if ($request->ajax()) {
            $minuta = RevisionMinuta::where('id', '=', intval($request->revision))->first();

            $minuta->update([
                'comentarios' => $request->comentarios,
                'estatus' => strval(RevisionMinuta::RECHAZADO),
            ]);
            $minutaOriginal = Minutasaltadireccion::find($minuta->minuta_id);

            $email = $minuta->empleado->email;
            $this->sendMailReject($email, $minutaOriginal, $minuta);
            $this->allLevelSendAnswer($minuta->minuta_id, $minutaOriginal);
            if ($this->allSendAnswer($minuta->minuta_id)) {
                $historialRevisionMinuta = HistoralRevisionMinuta::where('minuta_id', '=', $minuta->minuta_id)->where('estatus', '=', strval(Minutasaltadireccion::EN_ELABORACION))->first();
                if ($historialRevisionMinuta) {
                    $historialDocumento = HistoralRevisionMinuta::find($historialRevisionMinuta->id);
                    if ($this->containsReject($minuta->minuta_id)) {
                        $minutaOriginal->update([
                            'estatus' => strval(Minutasaltadireccion::DOCUMENTO_RECHAZADO),
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Minutasaltadireccion::DOCUMENTO_RECHAZADO),
                        ]);
                    } else {
                        $path_documento_aprobacion = 'public/minutas/en aprobacion/'.$minutaOriginal->documento;
                        $ruta_publicacion = 'public/minutas/aprobadas/'.$minutaOriginal->documento;
                        $minutaOriginal->update([
                            'estatus' => strval(Minutasaltadireccion::PUBLICADO),
                        ]);

                        $historialDocumento->update([
                            'estatus' => strval(Minutasaltadireccion::PUBLICADO),
                        ]);

                        if (Storage::exists($path_documento_aprobacion)) {
                            Storage::move($path_documento_aprobacion, $ruta_publicacion);
                        }

                        $documentoAct = Minutasaltadireccion::with('responsable')->find($minutaOriginal->id);
                        $this->sendMailPublish($documentoAct->responsable->email, $documentoAct);
                    }
                }
            }

            return response()->json(['reject' => true]);
        }
    }

    public function sendMailApprove($mail, $modelo, $revision)
    {
        Mail::to(removeUnicodeCharacters($mail))->queue(new MinutaConfirmacionAprobacion($modelo, $revision));
    }

    public function sendMailPublish($mail, $modelo)
    {
        Mail::to(removeUnicodeCharacters($mail))->queue(new MinutaAprobada($modelo));
    }

    public function sendMailNotPublish($mail, $modelo)
    {
        Mail::to(removeUnicodeCharacters($mail))->queue(new MinutaRechazada($modelo));
    }

    public function sendMailReject($mail, $modelo, $revision)
    {
        Mail::to(removeUnicodeCharacters($mail))->queue(new MinutaConfirmacionRechazo($modelo, $revision));
    }
}
