<?php

namespace App\Http\Livewire;

use App\Models\MatrizOctaveEscenario;
use App\Models\MatrizOctaveProceso;
use Livewire\Component;


class BodyCartaAceptacion extends Component
{

    public $procesoId ;
    public $proceso_data ;
    public $operacional;
    public $legal;
    public $cumplimiento;
    public $reputacional;
    public $tecnologico;
    public $activos;
    public $escenarios;
    public $operacionalTxt;
    public $legalTxt;
    public $cumplimientoTxt;
    public $reputacionalTxt;
    public $tecnologicoTxt;
    public $impacto;
    public $probabilidad;
    public $promedioDisponibilidad = [] ;
    public $promedioIntegridad = [];
    public $promedioConfidencialidad= [];
    public $coordenada_tabla= '4,5';

    public function mount(){
        $this->proceso_id = MatrizOctaveProceso::first()->id;
    }

    public function render()
    {
        $procesos = MatrizOctaveProceso::where('nivel_riesgo','>',51)->get();
        return view('livewire.body-carta-aceptacion',compact('procesos'));
    }

    public function updatedProcesoId($value)
    {
        $this->procesoId = $value;
        $proceso = $this->buscarProceso($this->procesoId);
        $this->printTable($proceso);
    }

    private function printTable($proceso){
        $this->operacional = $proceso->operacional;
        $this->legal = $proceso->legal;
        $this->cumplimiento = $proceso->cumplimiento;
        $this->reputacional = $proceso->reputacional;
        $this->tecnologico = $proceso->tecnologico;
        $this->activos = $proceso->proceso->activosAI;
        $soloEscenarios = collect();
        foreach($this->activos as $activo){
            foreach($activo->contenedores as $contenedor){
                $soloEscenarios->push($contenedor->escenarios);
            }
        }
        $this->escenarios = $soloEscenarios;
        $this->impacto = round(( $this->operacional + $this-> legal + $this-> cumplimiento + $this-> reputacional + $this-> tecnologico)/ 5);

        // Texto impacto Operacional
        if ($this->operacional == 5){
            $this->operacionalTxt = 'Desfase en las operaciones iniciando operaciones al día siguiente generando retrasos y cumplimiento con clientes en las operaciones';
        }elseif ($this->operacional == 4) {
            $this->operacionalTxt = 'Desfase en las operaciones fuera de horario laboral > 8 hrs';
        }elseif ($this->operacional == 3){
            $this->operacionalTxt = 'Desfase en las operaciones fuera de horario laboral > 4 hrs';
        }elseif ($this->operacional == 2){
            $this->operacionalTxt = 'Desfase en las operaciones fuera de horario laboral entre > 2 hrs';
        }elseif ($this->operacional == 1){
            $this->operacionalTxt = 'Incidencias manejadas dentro del horario laboral';
        }elseif ($this->operacional == 0){
            $this->operacionalTxt = ' No se considera riesgo operacional asociado al riesgo evaluado';
        }

          // Texto impacto Legal
          if ($this->legal == 5){
            $this->legalTxt = 'Cierre de negocios relevantes e incremento de demandas';
        }elseif ($this->legal == 4) {
            $this->legalTxt = 'Demandas y revocación de contratos de uno o varios clientes relevantes';
        }elseif ($this->legal == 3){
            $this->legalTxt = 'Operación con licencias restringidas sin afectar a los clientes sin llegar a demandas';
        }elseif ($this->legal == 2){
            $this->legalTxt = 'Pérdida de contratos de clientes no relevantes y acciones legales con poca afectación';
        }elseif ($this->legal == 1){
            $this->legalTxt = 'No existen demandas de clientes y acciones legales en contra';
        }elseif ($this->legal == 0){
            $this->legalTxt = ' No se considera riesgo legal asociado al riesgo evaluado';
        }

         // Texto impacto Cumplimiento
         if ($this->cumplimiento == 5){
            $this->cumplimientoTxt = 'Revocación de concesiones y autorización de operación';
        }elseif ($this->cumplimiento == 4) {
            $this->cumplimientoTxt = 'Suspensión de operaciones > 1 día';
        }elseif ($this->cumplimiento == 3){
            $this->cumplimientoTxt = 'Visitas de Inspección con observaciones';
        }elseif ($this->cumplimiento == 2){
            $this->cumplimientoTxt = 'Requerimientos de Información';
        }elseif ($this->cumplimiento == 1){
            $this->cumplimientoTxt = 'Sin requerimientos y observaciones por él regulados';
        }elseif ($this->cumplimiento == 0){
            $this->cumplimientoTxt = ' No se considera riesgo cumplimiento asociado al riesgo evaluado';
        }

         // Texto impacto Reputacional
         if ($this->reputacional == 5){
            $this->reputacionalTxt = 'Daños reputacionales a través de medios AAA Tradicionales Internacionales dañando la imagen y fuga de clientes';
        }elseif ($this->reputacional == 4) {
            $this->reputacionalTxt = 'Daños reputacionales a través de medios AAA Tradicionales Nacionales con afectación < a 30 días';
        }elseif ($this->reputacional == 3){
            $this->reputacionalTxt = 'Daños reputacionales en medios B y C Tradicionales  con afectación de  2 a 10 días';
        }elseif ($this->reputacional == 2){
            $this->reputacionalTxt = 'Daños reputacionales en medios tradicionales y redes sociales con afectación de 1 día';
        }elseif ($this->reputacional == 1){
            $this->reputacionalTxt = 'Divulgación de empleados o externos sin afectación a la organización por cualquier medio.';
        }elseif ($this->reputacional == 0){
            $this->reputacionalTxt = 'No se considera riesgo reputacional asociado al riesgo evaluado';
        }

          // Texto impacto Tecnologico
          if ($this->tecnologico == 5){
            $this->tecnologicoTxt = 'Pérdida de servicios de TI por > 1 día que impiden continuar con la operación activando procesos manuales';
        }elseif ($this->tecnologico == 4) {
            $this->tecnologicoTxt = 'Suspensión de servicios de TI > 8 hrs';
        }elseif ($this->tecnologico == 3){
            $this->tecnologicoTxt = 'Suspensión de servicios de TI >4 hrs';
        }elseif ($this->tecnologico == 2){
            $this->tecnologicoTxt = 'Suspensión de servicios de TI de 1 hr a 2 hrs';
        }elseif ($this->tecnologico == 1){
            $this->tecnologicoTxt = 'Interrupciones momentáneas derivado de incidentes tecnológicos sin afectación';
        }elseif ($this->tecnologico == 0){
            $this->tecnologicoTxt = 'No se considera riesgo tecnológico asociado al riesgo evaluado';
        }
    }

    private function buscarProceso($proceso){
        $proceso_data = MatrizOctaveProceso::with(['proceso'=>function($query){
            $query->with(['activosAI'=>function($q){
                $q->with(['contenedores'=>function($q){
                    $q->with(['escenarios'=>function($q){
                        $q->with('contenedor');
                    }]);
                }]);
            }]);
        }])->where('id','=',$proceso)->first();
        return $proceso_data;
    }
}
