<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisImpacto extends Model
{
    use HasFactory;


    public $table = 'cuestionario_analisis_impacto';

    const DisruptivoSelect = [
        '1' => 'Remoto (cada año)',
        '2' => 'Poco probable(Cada 6 meses)',
        '3' => 'Probable (Cada 3 meses)',
        '4' => 'Muy probable (cada mes',
        '5' => 'Casi cierto (Cada Semana)',
    ];



    public $fillable = [
        // DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO 
        'id',
        'fecha_entrevista',
        'entrevistado',
        'puesto',
        'area',
        'direccion',
        'extencion',
        'correo',
        'procesos_a_cargo',
        // DATOS DE IDENTIFICACIÓN DEL PROCESO
        'id_proceso',
        'nombre_proceso',
        'version',
        'tipo',
        'objetivo_proceso',
        'macroproceso',
        'subproceso',
        'periodicidad',
        'p_otro_txt',
        // RESPONSABLES DEL PROCESO
        'titular_nombre',
        'titular_a_paterno',
        'titular_a_materno',
        'titular_puesto',
        'titular_correo',
        'titular_extencion',
        'suplente_nombre',
        'suplente_a_paterno',
        'suplente_a_materno',
        'suplente_puesto',
        'suplente_correo',
        'suplente_extencion',
        'supervisor_nombre',
        'supervisor_a_paterno',
        'supervisor_a_materno',
        'supervisor_puesto',
        'supervisor_correo',
        'supervisor_extencion',
        // FLUJO DEL PROCESO
        'flujo_q_1',
        'flujo_q_2',
        'flujo_q_4',
        'periodicidad_diario',
        'periodicidad_quincenal',
        'periodicidad_mensual',
        'periodicidad_otro',
        'periodicidad_flujo_txt',
        'flujo_q_6',
        'flujo_q_7',
        'flujo_q_8',
        'flujo_q_10',
        'flujo_años',
        'flujo_meses',
        'flujo_semanas',
        'flujo_dias',
        'flujo_otro', //quitar
        'flujo_otro_txt',
        // RESPALDOS DE INFORMACIÓN
        'respaldo_q_20',
        'respaldo_q_21',
        'respaldo_q_22',
        'respaldo_q_23',
        // PROBABILIDAD DE INCIDENTES DISRUPTIVOS
        'disruptivos_q_1',
        'disruptivos_q_2',
        'disruptivos_q_3',
        'disruptivos_q_4',
        'disruptivos_q_5',
        'disruptivos_q_6',
        'disruptivos_q_7',
        'disruptivos_q_8',
        'disruptivos_q_9',
        'disruptivos_q_10',
        'disruptivos_q_11',
        // RIESGOS E INCIDENTES DISRUPTIVOS
        'operacion_q_1',
        'operacion_q_2',
        'operacion_q_3',
        'regulatorio_q_1',
        'regulatorio_q_2',
        'regulatorio_q_3',
        'reputacion_q_1',
        'reputacion_q_2',
        'reputacion_q_3',
        'social_q_1',
        'social_q_2',
        'social_q_3',
        'incidentes_q_26',
        'incidentes_q_27',
        // firmas
        'firma_Entrevistado',
        'firma_Jefe',
        'firma_Entrevistador',
        'exite_firma_Entrevistado',
        'exite_firma_Jefe',
        'exite_firma_Entrevistador',
        // PERÍODOS CRÍTICOS
        'primer_semestre',
        'segundo_semestre',
        'ene',
        'feb',
        'mar',
        'abr',
        'may',
        'jun',
        'jul',
        'ago',
        'sep',
        'oct',
        'nov',
        'dic',
        's1',
        's2',
        's3',
        's4',
        'd1',
        'd2',
        'd3',
        'd4',
        'd5',
        'd6',
        'd7',
        'd8',
        'd9',
        'd10',
        'd11',
        'd12',
        'd13',
        'd14',
        'd15',
        'd16',
        'd17',
        'd18',
        'd19',
        'd20',
        'd21',
        'd22',
        'd23',
        'd24',
        'd25',
        'd26',
        'd27',
        'd28',
        'd29',
        'd30',
        'd31',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'h7',
        'h8',
        'h9',
        'h10',
        'h11',
        'h12',
        'h13',
        'h14',
        'h15',
        'h16',
        'h17',
        'h18',
        'h19',
        'h20',
        'h21',
        'h22',
        'h23',
        'h24',
    ];

    protected $appends=[
        'cantidad_total_personas_normal',
        'cantidad_total_personas_contingencia',
        'cantidad_equipo_computo_normal',
        'cantidad_telefonia_normal',
        'cantidad_impresora_normal',
        'cantidad_otros_normal',
        'cantidad_equipo_computo_contingencia',
        'cantidad_telefonia_contingencia',
        'cantidad_impresora_contingencia',
        'cantidad_otros_contingencia',
        'cantidad_proporciona_informacion',
        'cantidad_recibe_informacion',
        'diferencia_flujo_informacion',
    ];

     // Appens 3.0 Entradas y salidas
     public function recibeInformacion(){
        return $this->hasMany(CuestionarioRecibeInformacion::class, 'cuestionario_id');
    }
    public function proporcionaInformacion(){
        return $this->hasMany(CuestionarioProporcionaInformacion::class, 'cuestionario_id');
    }

    public function getCantidadRecibeInformacionAttribute(){
        return $this->recibeInformacion()->count();
    }

    public function getCantidadProporcionaInformacionAttribute(){
        return $this->proporcionaInformacion()->count();
    }

   

    public function getDiferenciaFlujoInformacionAttribute(){
        $proporciona = $this->getCantidadProporcionaInformacionAttribute();
        $recibe = $this->getCantidadRecibeInformacionAttribute();
       
        if( $proporciona > $recibe){
            $rowspan = $proporciona;
        }elseif( $recibe > $proporciona){
            $rowspan = $recibe;
        }elseif( $recibe == $proporciona){
            $rowspan = $proporciona;
        }

        $diferencia =  $proporciona - $recibe;

        return  [$diferencia, 2];
    }

    // Appens 5.0 Requerimientos minimos

    public function recursosHumanos(){
        return $this->hasMany(CuestionarioRecursosHumanos::class, 'cuestionario_id');
    }

    public function getCantidadTotalPersonasNormalAttribute(){
        return $this->recursosHumanos()->where('escenario','1')->count();
    }

    public function getCantidadTotalPersonasContingenciaAttribute(){
        return $this->recursosHumanos()->where('escenario','2')->count();
    }

    public function recursosMateriales(){
        return $this->hasMany(CuestionarioRecursosMateriales::class, 'cuestionario_id');
    }

    public function getCantidadEquipoComputoNormalAttribute(){
        return $this->recursosMateriales()->where('escenario','1')->pluck('equipos')->sum();
    }
    public function getCantidadTelefoniaNormalAttribute(){
        return $this->recursosMateriales()->where('escenario','1')->pluck('telefono')->sum();
    }
    public function getCantidadImpresoraNormalAttribute(){
        return $this->recursosMateriales()->where('escenario','1')->pluck('impresoras')->sum();
    }
    public function getCantidadOtrosNormalAttribute(){
        return $this->recursosMateriales()->where('escenario','1')->pluck('otro')->first();
    }
    public function getCantidadEquipoComputoContingenciaAttribute(){
        return $this->recursosMateriales()->where('escenario','2')->pluck('equipos')->sum();
    }
    public function getCantidadTelefoniaContingenciaAttribute(){
        return $this->recursosMateriales()->where('escenario','2')->pluck('telefono')->sum();
    }
    public function getCantidadImpresoraContingenciaAttribute(){
        return $this->recursosMateriales()->where('escenario','2')->pluck('impresoras')->sum();
    }
    public function getCantidadOtrosContingenciaAttribute(){
        return $this->recursosMateriales()->where('escenario','2')->pluck('otro')->first();
    }


   
}
