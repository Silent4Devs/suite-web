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
    ];
}
