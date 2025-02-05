<?php

namespace App\Http\Controllers;

use App\Events\CatalogueCertificatesEvent;
use App\Mail\ApprovalNotificationCertificatesMail;
use App\Mail\CertificatesMail;
use App\Mail\RejectionNotificationCertificatesMail;
use App\Models\ComentariosProcesosListaDistribucion;
use App\Models\ControlListaDistribucion;
use App\Models\ListaDistribucion;
use App\Models\ProcesosListaDistribucion;
use App\Models\TBCatalogueTrainingModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CertificatesController extends Controller
{
    private $modelo = 'TBCatalogueTrainingModel';

    //
    public function TypeCatalogueTraining()
    {
        return view('admin.typeCatalogueTraining.tbIndex');
    }

    public function CatalogueTraining()
    {
        return view('admin.catalogueTraining.tbIndex');
    }

    public function UserTraining()
    {
        // Route::post('/enviar-datos', [MiControlador::class, 'recibirDatos'])->name('enviar.datos');
        return view('admin.training.tbIndex');
    }

    public function revision($id)
    {
        $modelo = 'TBCatalogueTrainingModel';

        $catalogueTraining = TBCatalogueTrainingModel::find($id);

        if (! $catalogueTraining) {
            abort(404);
        }

        $modulo = ListaDistribucion::where('modelo', '=', $modelo)->first();

        $proceso = ProcesosListaDistribucion::with('participantes')
            ->where('modulo_id', '=', $modulo->id)
            ->where('proceso_id', '=', $catalogueTraining->id)
            ->first();

        $no_niveles = $modulo->niveles;

        $acceso_restringido = 'correcto';

        if ($proceso->estatus == 'Pendiente') {
            for ($i = 0; $i <= $no_niveles; $i++) {
                foreach ($proceso->participantes as $part) {
                    if (
                        $part->participante->nivel == $i && $part->estatus == 'Pendiente'
                        && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                    ) {

                        for ($j = 1; $j <= 5; $j++) {
                            if (
                                $part->participante->numero_orden == $j && $part->estatus == 'Pendiente'
                                && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                            ) {
                                return view('admin.catalogueTraining.tbApprove', compact('catalogueTraining', 'acceso_restringido'));
                                break;
                            } elseif (
                                ! ($part->estatus == 'Pendiente')
                                && ! ($part->participante->empleado_id == User::getCurrentUser()->empleado->id)
                            ) {
                                $acceso_restringido = 'turno';

                                return view('admin.catalogueTraining.tbApprove', compact('catalogueTraining', 'acceso_restringido'));
                            }
                        }
                    } elseif (
                        $part->participante->nivel == 0 && $part->estatus == 'Pendiente'
                        && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                    ) {
                        return view('admin.catalogueTraining.tbApprove', compact('catalogueTraining', 'acceso_restringido'));
                        break;
                    }
                }
            }
            $acceso_restringido = 'denegado';

            return view('admin.catalogueTraining.tbApprove', compact('catalogueTraining', 'acceso_restringido'));
        } else {
            $acceso_restringido = 'aprobado';

            return view('admin.catalogueTraining.tbApprove', compact('catalogueTraining', 'acceso_restringido'));
        }
    }

    public function aprobado($id, Request $request)
    {
        $aprobador = User::getCurrentUser()->empleado->id;

        $catalogueTraining = TBCatalogueTrainingModel::find($id);

        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();
        try {
            //code...
            event(new CatalogueCertificatesEvent($catalogueTraining, 'aprobado', 'catalogue_training', 'Certificado', 'LD'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $proceso_general = ProcesosListaDistribucion::with('participantes')
            ->where('modulo_id', '=', $modulo->id)
            ->where('proceso_id', '=', $id)
            ->with([
                'modulo' => function ($query) {
                    $query->where('modelo', '=', $this->modelo);
                },
            ])
            ->first();

        $proceso = ProcesosListaDistribucion::with([
            'modulo' => function ($query) {
                $query->where('modelo', '=', $this->modelo);
            },
            'participantes' => function ($query) use ($aprobador) {
                $query->whereHas('participante', function ($subQuery) use ($aprobador) {
                    $subQuery->where('empleado_id', '=', $aprobador);
                });
            },
        ])->where('modulo_id', '=', $modulo->id)
            ->where('proceso_id', '=', $id)
            ->first();

        $comentario = ComentariosProcesosListaDistribucion::create([
            'comentario' => $request->comentario,
            'proceso_id' => $proceso->id,
        ]);

        $participante_control = $proceso->participantes[0];
        $participante = $proceso->participantes[0]->participante;

        //SuperAprobador
        if ($participante->nivel == 0) {
            $proceso->update([
                'estatus' => 'Aprobado',
            ]);
            foreach ($proceso_general->participantes as $p) {
                $p->update([
                    'estatus' => 'Aprobado',
                ]);
            }

            $catalogueTraining->update([
                'estatus' => 'Aprobado',
            ]);

            $this->correosAprobacion($proceso, $catalogueTraining);
        } else {
            $participante_control->update([
                'estatus' => 'Aprobado',
            ]);
            $this->confirmacionAprobacion($proceso_general, $catalogueTraining);
        }

        return redirect(route('admin.portal-comunicacion.index'));
    }

    public function correosAprobacion($proceso, $catalogueTraining)
    {
        $emailAprobado = $catalogueTraining->empleado->email;
        try {
            //code...
            Mail::to(removeUnicodeCharacters($emailAprobado))->queue(new ApprovalNotificationCertificatesMail($catalogueTraining->id, $catalogueTraining->name));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
        $procesoAprobado = ProcesosListaDistribucion::with('participantes')->find($proceso->id);
        foreach ($procesoAprobado->participantes as $part) {
            $emailAprobado = $part->participante->empleado->email;
            Mail::to(removeUnicodeCharacters($emailAprobado))->queue(new ApprovalNotificationCertificatesMail($catalogueTraining->id, $catalogueTraining->name));
        }
    }

    public function rechazado($id, Request $request)
    {
        $catalogueTraining = TBCatalogueTrainingModel::find($id);
        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();
        $aprobacion = ProcesosListaDistribucion::with('participantes')->where('proceso_id', '=', $id)->where('modulo_id', '=', $modulo->id)->first();

        try {
            //code...
            event(new CatalogueCertificatesEvent($catalogueTraining, 'rechazado', 'catalogue_training', 'Certificado', 'LD'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $comment = ComentariosProcesosListaDistribucion::create([
            'comentario' => $request->comentario,
            'proceso_id' => $aprobacion->id,
        ]);

        $catalogueTraining->update([
            'status' => 'reject',
        ]);

        $aprobacion->update([
            'estatus' => 'Rechazado',
        ]);

        foreach ($aprobacion->participantes as $p) {
            $p->update([
                'estatus' => 'Rechazado',
            ]);
        }
        $emailresponsable = $catalogueTraining->empleado->email;

        Mail::to(removeUnicodeCharacters($emailresponsable))->queue(new RejectionNotificationCertificatesMail($catalogueTraining->id, $catalogueTraining, $comment));

        foreach ($aprobacion->participantes as $participante) {
            Mail::to(removeUnicodeCharacters($participante->participante->empleado->email))->queue(new RejectionNotificationCertificatesMail($catalogueTraining->id, $catalogueTraining, $comment));
        }

        $catalogueTraining->delete();

        return redirect(route('admin.portal-comunicacion.index'));
    }

    public function confirmacionAprobacion($proceso, $catalogueTraining)
    {
        $confirmacion = ControlListaDistribucion::with('proceso')->where('proceso_id', '=', $proceso->id)
            ->withwhereHas('participante', function ($query) {
                return $query->where('nivel', '>', 0);
            })->get();

        $isSameEstatus = $confirmacion->every(function ($record) {
            return $record->estatus == 'Aprobado'; // Assuming 'estatus' is the column name
        });

        if ($isSameEstatus) {
            $proceso->update([
                'estatus' => 'Aprobado',
            ]);

            $catalogueTraining->update([
                'status' => 'approved',
            ]);

            $this->correosAprobacion($proceso, $catalogueTraining);
        } else {
            $this->siguienteCorreo($proceso, $catalogueTraining);
        }
    }

    public function siguienteCorreo($proceso, $catalogueTraining)
    {
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();

        $proceso_actualizado = ProcesosListaDistribucion::with('participantes')
            ->where('id', '=', $proceso->id)
            ->with([
                'modulo' => function ($query) {
                    $query->where('modelo', '=', $this->modelo);
                },
            ])
            ->first();

        $no_niveles = $lista->niveles;

        $breakLoop = false;

        for ($i = 1; $i <= $no_niveles; $i++) {
            foreach ($proceso_actualizado->participantes as $part) {
                if ($part->participante->nivel == $i && $part->estatus == 'Pendiente') {
                    for ($j = 1; $j <= 5; $j++) {
                        if ($part->participante->numero_orden == $j && $part->estatus == 'Pendiente') {
                            $emailAprobador = $part->participante->empleado->email;
                            Mail::to(removeUnicodeCharacters($emailAprobador))->queue(new CertificatesMail($catalogueTraining->id, $catalogueTraining->name));
                            $breakLoop = true;
                            break;
                        }
                    }
                    if ($breakLoop) {
                        break;
                    }
                }
            }
            if ($breakLoop) {
                break;
            }
        }
    }
}
