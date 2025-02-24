<?php

namespace App\Livewire;

use App\Exports\PanelDeclaracion2022\PanelDeclaracion2022Export;
use App\Mail\DeclaracionAplicabilidadIso;
use App\Models\Empleado;
use App\Models\Iso27\DeclaracionAplicabilidadAprobarIso;
use App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso;
use App\Models\Iso27\DeclaracionAplicabilidadResponsableIso;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class PanelDeclaracionAsignados2022 extends Component
{
    use LivewireAlert;
    use ObtenerOrganizacion;

    public $empleados;
    public $organizacion_actual;
    public $logo_actual;
    public $empresa_actual;
    public $array_asignados = [];

    public $select_envio = 'no_notificado';

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

    public function cambioResponsable($keyR)
    {
        if (!empty($this->array_asignados[$keyR]['responsable']['id'])) {
            $nr = $this->empleados->find($this->array_asignados[$keyR]['responsable']['id']);
            $nuevoResponsable = [
                'id' => $nr->id,
                'nombre' => $nr->name,
                'keyR' => $keyR
            ];

            $this->dispatch('asignacionResponsable', nuevoResponsable: $nuevoResponsable);
        }else{
            $nuevoResponsable = [
                'id' => null,
                'nombre' => null,
                'keyR' => $keyR
            ];

            $this->dispatch('desasignacionResponsable', nuevoResponsable: $nuevoResponsable);
        }
    }

    public function guardarResponsable($responsable)
    {
        $data = $this->array_asignados[$responsable['keyR']];
        $declaracion = $data['id_gap_dos_catalogo'];
        $responsableId = $responsable['id'];

        // Verificar si el responsable ya es aprobador
        $isAprobador = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracion)
            ->where('empleado_id', $responsableId)
            ->exists();

        if ($isAprobador) {
            $this->alert('warning', 'Ya fue asignado como aprobador', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        // Verificar si ya existe un responsable para esta declaración
        $existResponsable = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->exists();

        if (!$existResponsable) {
            // Si no existe, verificar si el empleado ya está asignado como responsable
            $isAlreadyResponsable = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)
                ->where('empleado_id', $responsableId)
                ->exists();

            if ($isAlreadyResponsable) {
                $this->alert('warning', 'Este responsable ya ha sido asignado', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return;
            }

            // Asignar nuevo responsable
            DeclaracionAplicabilidadResponsableIso::updateOrCreate(
                ['declaracion_id' => $declaracion],
                ['empleado_id' => $responsableId, 'esta_correo_enviado' => false]
            );

            $this->alert('success', 'Responsable asignado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        // Si ya existe un responsable, verificar si es reasignable (empleado_id es nulo)
        $isReasignable = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)
            ->whereNull('empleado_id')
            ->exists();

        if ($isReasignable) {
            // Reasignar responsable
            DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)
                ->update(['empleado_id' => $responsableId, 'esta_correo_enviado' => false]);

            $this->alert('success', 'Responsable asignado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        // Si ya existe un responsable y no es reasignable, verificar si se está modificando el empleado_id
        $currentResponsable = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)
            ->where('empleado_id', '!=', $responsableId)
            ->first();

        if ($currentResponsable) {
            // Verificar si el nuevo empleado ya está asignado como responsable en otra declaración
            $isAlreadyAssigned = DeclaracionAplicabilidadResponsableIso::where('empleado_id', $responsableId)
                ->exists();

            if ($isAlreadyAssigned) {
                $this->alert('warning', 'Este empleado ya está asignado como responsable en otra declaración', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return;
            }

            // Modificar el empleado_id del responsable existente
            $currentResponsable->update([
                'empleado_id' => $responsableId,
                'esta_correo_enviado' => false,
            ]);

            $this->alert('success', 'Responsable modificado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        // Si no es reasignable y no se está modificando, devolver mensaje de límite alcanzado
        $this->alert('error', 'Límite de responsables alcanzado', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    // QUITAR EL RESPONSABLE
    public function quitarResponsable($responsable)
    {
        $data = $this->array_asignados[$responsable['keyR']];
        $declaracionId = $data['id_gap_dos_catalogo'];

        // Obtener el control con las relaciones necesarias
        $control = DeclaracionAplicabilidadConcentradoIso::with([
            'gapdos.clasificacion',
            'responsables2022.responsable_declaracion:id,name,foto',
            'responsables2022.empleado:id,name',
        ])->find($data['id']);

        // Verificar si existe un responsable asignado
        if ($control->responsables2022->isNotEmpty()) {
            $responsableID = $control->responsables2022->first()->responsable_declaracion->id;

            // Actualizar el registro del responsable (establecer empleado_id como null)
            $updated = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracionId)
                ->where('empleado_id', $responsableID)
                ->update([
                    'empleado_id' => null,
                    'esta_correo_enviado' => true,
                ]);

            if ($updated) {
                $this->alert('success', 'Responsable removido', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }
        }
    }

    public function cambioAprobador($keyR)
    {

        if (!empty($this->array_asignados[$keyR]['aprobador']['id'])) {
            $na = $this->empleados->find($this->array_asignados[$keyR]['aprobador']['id']);
            $nuevoAprobador = [
                'id' => $na->id,
                'nombre' => $na->name,
                'keyR' => $keyR
            ];

            $this->dispatch('asignacionAprobador', nuevoAprobador: $nuevoAprobador);
        }else{
            $nuevoAprobador = [
                'id' => null,
                'nombre' => null,
                'keyR' => $keyR
            ];

            $this->dispatch('desasignacionAprobador', nuevoAprobador: $nuevoAprobador);
        }
    }

    public function guardarAprobador($aprobador)
    {
        $data = $this->array_asignados[$aprobador['keyR']];
        $declaracionId = $data['id_gap_dos_catalogo'];
        $aprobadorId = $aprobador['id'];

        // Verificar si el aprobador ya es responsable
        $isResponsable = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracionId)
            ->where('empleado_id', $aprobadorId)
            ->exists();

        if ($isResponsable) {
            $this->alert('warning', 'Ya fue asignado como responsable', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        // Verificar si ya existe un aprobador para esta declaración
        $existAprobador = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracionId)->exists();

        if (!$existAprobador) {
            // Si no existe, verificar si el empleado ya está asignado como aprobador
            $isAlreadyAprobador = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracionId)
                ->where('empleado_id', $aprobadorId)
                ->exists();

            if ($isAlreadyAprobador) {
                $this->alert('warning', 'Este empleado ya ha sido asignado como aprobador', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return;
            }

            // Asignar nuevo aprobador
            DeclaracionAplicabilidadAprobarIso::updateOrCreate(
                ['declaracion_id' => $declaracionId],
                ['empleado_id' => $aprobadorId, 'esta_correo_enviado' => false]
            );

            $this->alert('success', 'Aprobador asignado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        // Si ya existe un aprobador, verificar si es reasignable (empleado_id es nulo)
        $isReasignable = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracionId)
            ->whereNull('empleado_id')
            ->exists();

        if ($isReasignable) {
            // Reasignar aprobador
            DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracionId)
                ->update(['empleado_id' => $aprobadorId, 'esta_correo_enviado' => false]);

            $this->alert('success', 'Aprobador asignado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        // Si ya existe un aprobador y no es reasignable, verificar si se está modificando el empleado_id
        $currentAprobador = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracionId)
            ->where('empleado_id', '!=', $aprobadorId)
            ->first();

        if ($currentAprobador) {
            // Verificar si el nuevo empleado ya está asignado como aprobador en otra declaración
            $isAlreadyAssigned = DeclaracionAplicabilidadAprobarIso::where('empleado_id', $aprobadorId)
                ->exists();

            if ($isAlreadyAssigned) {
                $this->alert('warning', 'Este empleado ya está asignado como aprobador en otra declaración', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return;
            }

            // Modificar el empleado_id del aprobador existente
            $currentAprobador->update([
                'empleado_id' => $aprobadorId,
                'esta_correo_enviado' => false,
            ]);

            $this->alert('success', 'Aprobador modificado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        // Si no es reasignable y no se está modificando, devolver mensaje de límite alcanzado
        $this->alert('error', 'Límite de aprobadores alcanzado', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    // QUITAR EL APROBADOR
    public function quitarAprobador($aprobador)
    {
        $data = $this->array_asignados[$aprobador['keyR']];
        $declaracionId = $data['id_gap_dos_catalogo'];

        // Obtener el control con las relaciones necesarias
        $control = DeclaracionAplicabilidadConcentradoIso::with([
            'gapdos.clasificacion',
            'aprobadores2022.aprobador_declaracion:id,name,foto',
            'aprobadores2022.empleado:id,name',
        ])->find($data['id']);

        // Verificar si existe un aprobador asignado
        if ($control->aprobadores2022->isNotEmpty()) {
            $aprobadorID = $control->aprobadores2022->first()->aprobador_declaracion->id;

            // Actualizar el registro del aprobador (establecer empleado_id como null)
            $updated = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracionId)
                ->where('empleado_id', $aprobadorID)
                ->update([
                    'empleado_id' => null,
                    'esta_correo_enviado' => true,
                ]);

            if ($updated) {
                $this->alert('success', 'Aprobador removido', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }
        }
    }

    public function enviarNotificacion()
    {
        $this->envioNotificacionControl($this->select_envio);
    }

    public function envioNotificacionControl($tipo, $keyR = null)
    {
        switch ($tipo) {
            case 'individual':
                $this->enviarCorreoIndividual($keyR);
                break;

            case 'no_notificado':
                $this->enviarCorreosNoNotificados();
                break;

            case 'todos':
                $this->enviarCorreosATodos();
                break;

            default:
                break;
        }

        $this->mostrarAlerta('success', 'Correo enviado');
    }

    private function enviarCorreoIndividual($keyR)
    {
        $empleado = Empleado::alta()->select('id', 'name', 'email')->find(intval($this->array_asignados[$keyR]['responsable']['id']));
        $declaracion = $this->array_asignados[$keyR]['id_gap_dos_catalogo'];

        $controles_name = $this->obtenerControlesNombre($empleado->id, $declaracion);

        $this->enviarCorreo($empleado, 'individual', $controles_name);
        $this->marcarCorreoComoEnviado($empleado->id);
    }

    private function enviarCorreosNoNotificados()
    {
        $destinatarios = DeclaracionAplicabilidadResponsableIso::where('esta_correo_enviado', false)
            ->distinct('empleado_id')
            ->pluck('empleado_id');

        $this->enviarCorreos($destinatarios, 'no_notificado');
    }

    private function enviarCorreosATodos()
    {
        $destinatarios = DeclaracionAplicabilidadResponsableIso::distinct('empleado_id')->pluck('empleado_id');

        $this->enviarCorreos($destinatarios, 'todos');
    }

    private function enviarCorreos($destinatarios, $tipo)
    {
        foreach ($destinatarios as $destinatario) {
            $empleado = Empleado::alta()->select('id', 'name', 'email')->find(intval($destinatario));
            $controles_name = $this->obtenerControlesNombre($empleado->id);

            $this->enviarCorreo($empleado, $tipo, $controles_name);
            $this->marcarCorreoComoEnviado($empleado->id);
        }
    }

    private function obtenerControlesNombre($empleado_id, $declaracion_id = null)
    {
        $query = DeclaracionAplicabilidadResponsableIso::with('gapdos')
            ->where('empleado_id', $empleado_id);

        if ($declaracion_id) {
            $query->where('declaracion_id', $declaracion_id);
        }

        return $query->get()->pluck('gapdos');
    }

    private function enviarCorreo($empleado, $tipo, $controles_name)
    {
        Mail::to(removeUnicodeCharacters($empleado->email))
            ->queue(new DeclaracionAplicabilidadIso($empleado->name, $tipo, $controles_name));
    }

    private function marcarCorreoComoEnviado($empleado_id)
    {
        DeclaracionAplicabilidadResponsableIso::where('empleado_id', $empleado_id)
            ->update(['esta_correo_enviado' => true]);
    }

    private function mostrarAlerta($type, $message)
    {
        $this->alert($type, $message, [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function descargarExcel()
    {
        $export = new PanelDeclaracion2022Export;

        return Excel::download($export, 'Controles2022.xlsx');
    }

    public function descargarCSV()
    {
        $export = new PanelDeclaracion2022Export;

        return Excel::download($export, 'Controles2022.xlsx');
    }
}
