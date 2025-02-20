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

    public function cambioResponsable($keyR){
        // dd(1, $keyR, $this->array_asignados[$keyR]);
        $nr = $this->empleados->find($this->array_asignados[$keyR]['responsable']['id']);
        $nuevoResponsable = [
            'id' => $nr->id,
            'nombre' => $nr->name
        ];

        $this->dispatch('asignacionResponsable', nuevoResponsable: $nuevoResponsable);
    }

    public function cambioAprobador($keyR){
        // dd(1, $keyR, $this->array_asignados[$keyR]);
        $nr = $this->empleados->find($this->array_asignados[$keyR]['aprobador']['id']);
        $nuevoAprobador = [
            'id' => $nr->id,
            'nombre' => $nr->name
        ];

        $this->dispatch('asignacionAprobador', nuevoAprobador: $nuevoAprobador);
    }

    public function render()
    {
        return view('livewire.panel-declaracion-asignados2022');
    }
}
