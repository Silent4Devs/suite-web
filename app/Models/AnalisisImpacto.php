<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisImpacto extends Model
{
    use HasFactory;


    public $table = 'cuestionario_analisis_impacto';



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
    ];
}
