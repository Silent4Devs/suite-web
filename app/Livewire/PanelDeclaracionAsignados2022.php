<?php

namespace App\Livewire;

use App\Models\Empleado;
use App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso;
use App\Traits\ObtenerOrganizacion;
use Livewire\Component;

class PanelDeclaracionAsignados2022 extends Component
{
    use ObtenerOrganizacion;

    public $empleados;
    public $organizacion_actual;
    public $logo_actual;
    public $empresa_actual;
    public $array_asignados = [];

    public function mount()
    {
        $this->empleados = Empleado::getAltaEmpleados()->sortBy('name');
        $this->organizacion_actual = $this->obtenerOrganizacion();
        $this->logo_actual = $this->organizacion_actual?->logo;
        $this->empresa_actual = $this->organizacion_actual?->empresa;

        $this->asignacionControles();
    }

    public function asignacionControles()
    {
        $asignados = DeclaracionAplicabilidadConcentradoIso::with([
            'gapdos.clasificacion',
            'responsables2022.responsable_declaracion:id,name,foto',
            'responsables2022.empleado:id,name',
            'aprobadores2022.aprobador_declaracion:id,name,foto',
            'aprobadores2022.empleado:id,name',
        ])->orderBy('id')->get();

        $this->array_asignados = $asignados->map(function ($as) {
            return [
                'id' => $as->id,
                'id_gap_dos_catalogo' => $as->id_gap_dos_catalogo,
                'gapdos' => [
                    'control_iso' => $as->gapdos?->control_iso,
                    'anexo_politica' => $as->gapdos?->anexo_politica,
                    'nombre_clasificacion' => $as->gapdos?->clasificacion?->nombre,
                ],
                'responsable' => [
                    'id' => $as->responsables2022?->empleado?->id,
                    'nombre' => $as->responsables2022?->empleado?->name,
                ],
                'aprobador' => [
                    'id' => $as->aprobadores2022?->empleado?->id,
                    'nombre' => $as->aprobadores2022?->empleado?->name,
                ],
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.panel-declaracion-asignados2022');
    }

    public function cambioResponsable($keyR){
        // dd(1, $keyR, $this->array_asignados[$keyR]);
        $nr = $this->empleados->find($this->array_asignados[$keyR]['responsable']['id']);
        $nuevoResponsable = [
            'id' => $nr->id,
            'nombre' => $nr->name,
            'keyR' => $keyR
        ];

        $this->dispatch('asignacionResponsable', nuevoResponsable: $nuevoResponsable);
    }

    public function guardarResponsable($responsable)
    {
        dd($responsable);

        $declaracion = $request->declaracion;
        $responsable = $request->responsable;
        $existResponsable = DeclaracionAplicabilidadResponsableIso::select('declaracion_id')->where('declaracion_id', $declaracion)->exists();

        $isReasignable = DeclaracionAplicabilidadResponsableIso::select('declaracion_id')->where('declaracion_id', $declaracion)->whereNull('empleado_id')->exists();
        $readyExistResponsable = DeclaracionAplicabilidadAprobarIso::select('declaracion_id')
            ->where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->exists();
        if ($readyExistResponsable) {
            return response()->json(['estatus' => 'ya_es_aprobador', 'message' => 'Ya fue asignado como aprobador'], 200);
        } else {
            if (! $existResponsable) {
                $exists = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->exists();
                if (! $exists) {
                    DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)
                        ->update([
                            'declaracion_id' => $declaracion,
                            'empleado_id' => $responsable,
                        ], [
                            'esta_correo_enviado' => false,

                        ]);

                    return response()->json(['estatus' => 'asignado', 'message' => 'Responsable asignado'], 200);
                } else {
                    return response()->json(['estatus' => 'ya_asignado', 'message' => 'Este responsable ya ha sido asignado'], 200);
                }
            } else {
                if ($isReasignable) {
                    DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->update(['empleado_id' => $responsable,  'esta_correo_enviado' => false]);

                    return response()->json(['estatus' => 'asignado', 'message' => 'Responsable asignado'], 200);
                } else {
                    return response()->json(['estatus' => 'limite_alcanzado', 'message' => 'Limite de responsables alcanzado'], 200);
                }
            }
        }
    }

    // Ruta donde vamos a guardar el responsable a traves del script
    // public function relacionarResponsable(Request $request)
    // {
    //     $declaracion = $request->declaracion;
    //     $responsable = $request->responsable;
    //     $existResponsable = DeclaracionAplicabilidadResponsableIso::select('declaracion_id')->where('declaracion_id', $declaracion)->exists();

    //     $isReasignable = DeclaracionAplicabilidadResponsableIso::select('declaracion_id')->where('declaracion_id', $declaracion)->whereNull('empleado_id')->exists();
    //     $readyExistResponsable = DeclaracionAplicabilidadAprobarIso::select('declaracion_id')
    //         ->where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->exists();
    //     if ($readyExistResponsable) {
    //         return response()->json(['estatus' => 'ya_es_aprobador', 'message' => 'Ya fue asignado como aprobador'], 200);
    //     } else {
    //         if (! $existResponsable) {
    //             $exists = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->exists();
    //             if (! $exists) {
    //                 DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)
    //                     ->update([
    //                         'declaracion_id' => $declaracion,
    //                         'empleado_id' => $responsable,
    //                     ], [
    //                         'esta_correo_enviado' => false,

    //                     ]);

    //                 return response()->json(['estatus' => 'asignado', 'message' => 'Responsable asignado'], 200);
    //             } else {
    //                 return response()->json(['estatus' => 'ya_asignado', 'message' => 'Este responsable ya ha sido asignado'], 200);
    //             }
    //         } else {
    //             if ($isReasignable) {
    //                 DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->update(['empleado_id' => $responsable,  'esta_correo_enviado' => false]);

    //                 return response()->json(['estatus' => 'asignado', 'message' => 'Responsable asignado'], 200);
    //             } else {
    //                 return response()->json(['estatus' => 'limite_alcanzado', 'message' => 'Limite de responsables alcanzado'], 200);
    //             }
    //         }
    //     }
    // }

    // QUITAR EL RESPONSABLE
    // public function quitarRelacionResponsable(Request $request)
    // {
    //     $declaracion = $request->declaracion;
    //     $responsable = $request->responsable;
    //     $registro = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->where('empleado_id', $responsable);

    //     $exists = $registro->exists();
    //     if ($exists) {
    //         $registro = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->update(['empleado_id' => null, 'esta_correo_enviado' => true]);

    //         return response()->json(['message' => 'Responsable desasignado', 'request' => $request->all()], 200);
    //     }
    // }

    public function cambioAprobador($keyR){
        // dd(1, $keyR, $this->array_asignados[$keyR]);
        $nr = $this->empleados->find($this->array_asignados[$keyR]['aprobador']['id']);
        $nuevoAprobador = [
            'id' => $nr->id,
            'nombre' => $nr->name
        ];

        $this->dispatch('asignacionAprobador', nuevoAprobador: $nuevoAprobador);
    }

}
