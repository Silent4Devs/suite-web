<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisAIA extends Model
{
    use HasFactory;


    public $table = 'analisis_aia';

    const TipoServerSelect = [
        '1' => 'Físico',
        '2' => 'Virtual',
        
    ];
    const TipoAccesoSelect = [
        '1' => 'WEB',
        '2' => 'Cliente-Servidor',
        '3' => 'N/A',
        
    ];

    const TipoCertificadoSelect = [
        '1' => 'Sí',
        '2' => 'No',
        '3' => 'N/A',
        
    ];

    const TipoInternetSelect = [
        '1' => 'Sí',
        '2' => 'No',
        '3' => 'N/A',
        
    ];

    public $fillable = [

        'id',
        'fecha_entrevista',
        'entrevistado',
        'puesto',
        'area',
        'direccion',
        'extencion',
        'correo',
        'aplicaciones_a_cargo',
        // DATOS DE IDENTIFICACIÓN DEL PROCESO
        'id_aplicacion',
        'nombre_aplicacion',
        'version',
        'tipo',
        'objetivo_aplicacion',
        'periodicidad',
        'p_otro_txt',
        'area_pertenece_aplicacion',
        'area_responsable_aplicacion',
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
       'flujo_q_5',

        //INFRAESTRUCTURA TECNOLÓGICA
       'app_ip',
       'bd_ip',
       'otro_ip',
       'app_host',
       'bd_host',
       'otro_host',
       'app_base',
       'bd_base',
       'otro_base',
       'app_puerto',
       'bd_puerto',
       'otro_puerto',
       'app_servidor',
       'bd_servidor',
       'otro_servidor',
       'app_SO',
       'bd_SO',
       'otro_SO',
       'app_acceso',
       'bd_acceso',
       'otro_acceso',
       'app_url',
       'bd_url',
       'otro_url',
       'app_ip_publica',
       'bd_ip_publica',
       'otro_ip_publica',
       'app_certificado',
       'bd_certificado',
       'otro_certificado',
       'app_tipo_cifrado',
       'bd_tipo_cifrado',
       'otro_tipo_cifrado',
       'app_internet',
       'bd_internet',
       'otro_internet',
       'app_datos_url',
       'bd_datos_url',
       'otro_datos_url',
       'app_acceso_moviles',
       'bd_acceso_moviles',
       'otro_acceso_moviles',
       'app_nombre_app_movil',
       'bd_nombre_app_movil',
       'otro_nombre_app_movil',
       'app_interaccion_otras_apps',
       'bd_interaccion_otras_apps',
       'otro_interaccion_otras_apps',
       'app_datos_interactuan',
       'bd_datos_interactuan',
       'otro_datos_interactuan',
       'app_soporte_terceros',
       'bd_soporte_terceros',
       'otro_soporte_terceros',
       'app_datos_terceros',
       'bd_datos_terceros',
       'otro_datos_terceros',
       'app_instancia_balanceo',
       'bd_instancia_balanceo',
       'otro_instancia_balanceo',
       'app_datos_balanceo',
       'bd_datos_balanceo',
       'otro_datos_balanceo',
       'app_sofware_adicional',
       'bd_sofware_adicional',
       'otro_sofware_adicional',
       'app_lenguajes',
       'bd_lenguajes',
       'otro_lenguajes',
       'contingencia_app_ip',
       'contingencia_bd_ip',
       'contingencia_otro_ip',
       'contingencia_app_host',
       'contingencia_bd_host',
       'contingencia_otro_host',
       'contingencia_app_servidor',
       'contingencia_bd_servidor',
       'contingencia_otro_servidor',
       'contingencia_app_SO',
       'contingencia_bd_SO',
       'contingencia_otro_SO',
       'contingencia_app_acceso',
       'contingencia_bd_acceso',
       'contingencia_otro_acceso',
       'contingencia_app_url',
       'contingencia_bd_url',
       'contingencia_otro_url',

    ];
}
