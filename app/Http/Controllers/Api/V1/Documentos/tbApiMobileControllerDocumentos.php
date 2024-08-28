<?php

namespace App\Http\Controllers\Api\V1\Documentos;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\HistorialRevisionDocumento;
use App\Models\HistorialVersionesDocumento;
use App\Models\Macroproceso;
use App\Models\Proceso;
use App\Models\RevisionDocumento;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;

class tbApiMobileControllerDocumentos extends Controller
{
    use ObtenerOrganizacion;

    public function tbFunctionIndexUsuario()
    {
        function encodeSpecialCharacters($url)
        {
            // Handle spaces
            // $url = str_replace(' ', '%20', $url);
            // Encode other special characters, excluding /, \, and :
            $url = preg_replace_callback('/[^A-Za-z0-9_\-\.~\/\\\:]/', function ($matches) {
                return rawurlencode($matches[0]);
            }, $url);

            return $url;
        }

        $empleado = User::getCurrentUser()->empleado;

        $documentos = Documento::with('revisiones.empleadoMobile')->where('estatus', 2)->orderByDesc('id')->get();
        // $documentos = Documento::with('revisor', 'elaborador', 'aprobador', 'responsable', 'revisiones', 'proceso', 'macroproceso')->orderByDesc('id')->get();

        // dd($documentos);
        foreach ($documentos as $keyDocumento => $documento) {
            $documento->makeHidden(['created_at', 'updated_at', 'deleted_at']);
            if (!$documento->revisiones->isEmpty()) {
                foreach ($documento->revisiones as $keyrevision => $revision) {
                    if ($revision->empleadoMobile) {
                        if ($revision->empleadoMobile->foto == null || $revision->empleadoMobile->foto == '0') {
                            $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                        } else {
                            $ruta = asset('storage/empleados/imagenes/' . $revision->empleadoMobile->foto);
                        }

                        // Encode spaces in the URL
                        $revision->id_empleado = $revision->empleadoMobile->id;
                        $revision->nombre_empleado = $revision->empleadoMobile->name;
                        $revision->ruta_foto = encodeSpecialCharacters($ruta);

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
        }

        // $macroprocesos = Macroproceso::getAll()->pluck('nombre')->toArray();
        // $procesos = Proceso::pluck('nombre')->toArray();
        // $macroprocesosAndProcesos = array_merge($macroprocesos, $procesos);

        return response(json_encode([
            'documentos' => $documentos,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function handleApprovalOrRejection(Request $request, $action)
    {
        dd($request, $action);
        $documento = RevisionDocumento::where('id', '=', intval($request->revision))->first();
        $estatus = ($action === 'approve') ? Documento::APROBADO : Documento::RECHAZADO;
        $documento->update([
            'comentarios' => $request->comentarios,
            'estatus' => strval($estatus),
        ]);

        $documentoOriginal = Documento::with('elaborador')->find($documento->documento_id);
        $email = ($action === 'approve') ? $documentoOriginal->elaborador->email : $documento->empleado->email;

        if ($action === 'approve') {
            $this->sendMailApprove($email, $documentoOriginal, $documento);
        } else {
            $this->sendMailReject($email, $documentoOriginal, $documento);
        }

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

                    $this->publishDocumentInFolder($path_documentos_aprobacion . '/' . $documentoOriginal->archivo, $documentoOriginal);

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

        return response()->json([$action => true]);
    }
}
