<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AnalisisAIA extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'analisis_aia';

    const TipoServerSelect = [
        '1' => 'Físico',
        '2' => 'Virtual',

    ];

    const TipoAccesoSelect = [
        '1' => 'WEB',
        '2' => 'Cliente-Servidor',
        '3' => 'N/a',

    ];

    const TipoCertificadoSelect = [
        '1' => 'Sí',
        '2' => 'No',
        '3' => 'N/a',

    ];

    const TipoInternetSelect = [
        '1' => 'Sí',
        '2' => 'No',
        '3' => 'N/a',

    ];

    const AmbienteSelect = [
        '1' => 'Productivo',
        '2' => 'Desarrollo',
    ];

    const PublicacionSelect = [
        '1' => 'Interno',
        '2' => 'Externo',
    ];

    const DisruptivoSelect = [
        '1' => 'Remoto (cada año)',
        '2' => 'Poco probable(Cada 6 meses)',
        '3' => 'Probable (Cada 3 meses)',
        '4' => 'Muy probable (cada mes',
        '5' => 'Casi cierto (Cada Semana)',
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
        // TIEMPOS DE RECUPERACIÓN
        'rpo_mes',
        'rpo_semana',
        'rpo_dia',
        'rpo_hora',
        'rto_mes',
        'rto_semana',
        'rto_dia',
        'rto_hora',
        'wrt_mes',
        'wrt_semana',
        'wrt_dia',
        'wrt_hora',
        'mtpd_mes',
        'mtpd_semana',
        'mtpd_dia',
        'mtpd_hora',
        // RESPALDOS DE INFORMACIÓN
        'respaldo_q_14',
        'respaldo_q_15',
        'respaldo_q_16',

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
        'operacion_q_4',
        'regulatorio_q_1',
        'regulatorio_q_2',
        'regulatorio_q_3',
        'regulatorio_q_4',
        'reputacion_q_1',
        'reputacion_q_2',
        'reputacion_q_3',
        'reputacion_q_4',
        'social_q_1',
        'social_q_2',
        'social_q_3',
        'social_q_4',
        'q_19',
        // Firmas
        'firma_Entrevistado',
        'firma_Jefe',
        'firma_Entrevistador',
        'exite_firma_Entrevistado',
        'exite_firma_Jefe',
        'exite_firma_Entrevistador',
        // Agregados posteriormente
        'productivo_desarrollo',
        'interno_externo',
        'manejador_bd',

    ];

    protected $appends = [
        'cantidad_total_personas_normal',
        'cantidad_total_personas_contingencia',
        'cantidad_equipo_computo_normal',
        'cantidad_telefonia_normal',
        'cantidad_impresora_normal',
        'cantidad_otros_normal',
        'descripcion_otros_normal',
        'cantidad_equipo_computo_contingencia',
        'cantidad_telefonia_contingencia',
        'cantidad_impresora_contingencia',
        'cantidad_otros_contingencia',
        'datos_personas_contingencia',
        'datos_personas_contingencia_dif',
        'rowspan_ajuste',
        'rpo_horas',
        'rto_horas',
        'wrt_horas',
        'mtpd_horas',
        'nivel_rto',
        'operacion_promedio',
        'regulatorio_promedio',
        'reputacion_promedio',
        'social_promedio',
        'total_impactos',
        'nivel_impacto',
        'criticidad_proceso',
    ];

    // Appens 2.0 Matriz BIA
    public function getRpoHorasAttribute()
    {
        $mese_rpo = $this->rpo_mes * 730;
        $semana_rpo = $this->rpo_semana * 168;
        $dia_rpo = $this->rpo_dia * 24;
        $hora_rpo = $this->rpo_hora;
        $total_horas = $mese_rpo + $semana_rpo + $dia_rpo + $hora_rpo;

        return $total_horas;
    }

    public function getRtoHorasAttribute()
    {
        $mese_rto = $this->rto_mes * 730;
        $semana_rto = $this->rto_semana * 168;
        $dia_rto = $this->rto_dia * 24;
        $hora_rto = $this->rto_hora;
        $total_horas = $mese_rto + $semana_rto + $dia_rto + $hora_rto;

        return $total_horas;
    }

    public function getWrtHorasAttribute()
    {
        $mese_wrt = $this->wrt_mes * 730;
        $semana_wrt = $this->wrt_semana * 168;
        $dia_wrt = $this->wrt_dia * 24;
        $hora_wrt = $this->wrt_hora;
        $total_horas = $mese_wrt + $semana_wrt + $dia_wrt + $hora_wrt;

        return $total_horas;
    }

    public function getMtpdHorasAttribute()
    {
        $mese_mtpd = $this->mtpd_mes * 730;
        $semana_mtpd = $this->mtpd_semana * 168;
        $dia_mtpd = $this->mtpd_dia * 24;
        $hora_mtpd = $this->mtpd_hora;
        $total_horas = $mese_mtpd + $semana_mtpd + $dia_mtpd + $hora_mtpd;

        return $total_horas;
    }

    public function getNivelRtoAttribute()
    {
        $parametro = $this->rto_horas;
        if ($parametro <= 24) {
            $color = '#FF3333';
            $color_texto = '#FFFFFF';
            $texto = 'Alto';
        } elseif ($parametro <= 72) {
            $color = '#FFC000';
            $color_texto = '#000000';
            $texto = 'Medio';
        } elseif ($parametro > 72) {
            $color = '#00B050';
            $color_texto = '#000000';
            $texto = 'Bajo';
        } else {
            $color = '#FFFFFF';
            $color_texto = '#000000';
            $texto = 'No definido';
        }

        return [$color,  $color_texto, $texto];
    }

    public function getOperacionPromedioAttribute()
    {
        $parametro_1 = $this->operacion_q_1;
        $parametro_2 = $this->operacion_q_2;
        $parametro_3 = $this->operacion_q_3;
        $parametro_4 = $this->operacion_q_4;
        $promedio = ($parametro_1 + $parametro_2 + $parametro_3 + $parametro_4) / 4;

        return round($promedio);
    }

    public function getRegulatorioPromedioAttribute()
    {
        $parametro_1 = $this->regulatorio_q_1;
        $parametro_2 = $this->regulatorio_q_2;
        $parametro_3 = $this->regulatorio_q_3;
        $parametro_4 = $this->regulatorio_q_4;
        $promedio = ($parametro_1 + $parametro_2 + $parametro_3 + $parametro_4) / 4;

        return round($promedio);
    }

    public function getReputacionPromedioAttribute()
    {
        $parametro_1 = $this->reputacion_q_1;
        $parametro_2 = $this->reputacion_q_2;
        $parametro_3 = $this->reputacion_q_3;
        $parametro_4 = $this->reputacion_q_4;
        $promedio = ($parametro_1 + $parametro_2 + $parametro_3 + $parametro_4) / 4;

        return round($promedio);
    }

    public function getSocialPromedioAttribute()
    {
        $parametro_1 = $this->social_q_1;
        $parametro_2 = $this->social_q_2;
        $parametro_3 = $this->social_q_3;
        $parametro_4 = $this->social_q_4;
        $promedio = ($parametro_1 + $parametro_2 + $parametro_3 + $parametro_4) / 4;

        return round($promedio);
    }

    public function getTotalImpactosAttribute()
    {
        $impacto_operativo = AjustesAIA::pluck('impacto_operativo')->first();
        $impacto_regulatorio = AjustesAIA::pluck('impacto_regulatorio')->first();
        $impacto_reputacion = AjustesAIA::pluck('impacto_reputacion')->first();
        $impacto_social = AjustesAIA::pluck('impacto_social')->first();
        $parametro_1 = $this->operacion_promedio * $impacto_operativo;
        $parametro_2 = $this->regulatorio_promedio * $impacto_regulatorio;
        $parametro_3 = $this->reputacion_promedio * $impacto_reputacion;
        $parametro_4 = $this->social_promedio * $impacto_social;
        $promedio = ($parametro_1 + $parametro_2 + $parametro_3 + $parametro_4);

        return round($promedio);
    }

    public function getNivelImpactoAttribute()
    {
        $parametro = $this->total_impactos;
        if ($parametro <= 18) {
            $color = '#00B050';
            $color_texto = '#000000';
            $texto = 'Bajo';
        } elseif ($parametro <= 37) {
            $color = '#FFC000';
            $color_texto = '#000000';
            $texto = 'Medio';
        } elseif ($parametro <= 57) {
            $color = '#FF3333';
            $color_texto = '#FFFFFF';
            $texto = 'Alto';
        } else {
            $color = '#FFFFFF';
            $color_texto = '#000000';
            $texto = 'No definido';
        }

        return [$color,  $color_texto, $texto];
    }

    public function getCriticidadProcesoAttribute()
    {
        $nivel_rto = $this->nivel_rto[2];
        $nivel_impacto = $this->nivel_impacto[2];
        if ($nivel_impacto == 'Alto' and $nivel_rto == 'Alto') {
            $color = '#FF3333';
            $color_texto = '#FFFFFF';
            $texto = '1.Crítico';
        } elseif ($nivel_rto == 'Alto' and $nivel_impacto == 'Medio') {
            $color = '#FF3333';
            $color_texto = '#FFFFFF';
            $texto = '1.Crítico';
        } elseif ($nivel_rto == 'Alto' and $nivel_impacto == 'Bajo') {
            $color = '#FFC000';
            $color_texto = '#000000';
            $texto = '2.Importante';
        } elseif ($nivel_rto == 'Medio' and $nivel_impacto == 'Alto') {
            $color = '#FF3333';
            $color_texto = '#FFFFFF';
            $texto = '1.Crítico';
        } elseif ($nivel_rto == 'Medio' and $nivel_impacto == 'Medio') {
            $color = '#FFC000';
            $color_texto = '#000000';
            $texto = '2.Importante';
        } elseif ($nivel_rto == 'Medio' and $nivel_impacto == 'Bajo') {
            $color = '#00B050';
            $color_texto = '#000000';
            $texto = '3.Necesario';
        } elseif ($nivel_rto == 'Bajo' and $nivel_impacto == 'Alto') {
            $color = '#FFC000';
            $color_texto = '#000000';
            $texto = '2.Importante';
        } elseif ($nivel_rto == 'Bajo' and $nivel_impacto == 'Medio') {
            $color = '#00B050';
            $color_texto = '#000000';
            $texto = '3.Necesario';
        } elseif ($nivel_rto == 'Bajo' and $nivel_impacto == 'Bajo') {
            $color = '#00B050';
            $color_texto = '#000000';
            $texto = '3.Necesario';
        } else {
            $color = '#33A5FF';
            $color_texto = '#000000';
            $texto = 'Fuera de Rango';
        }

        return [$color,  $color_texto, $texto];
    }

    // Apenns Matriz apartado 3

    public function proporcionaInformacion()
    {
        return $this->hasMany(CuestionarioProporcionaInformacionAIA::class, 'cuestionario_id');
    }

    public function proporcionaMantenimientos()
    {
        return $this->hasMany(LiberaMantenimientoAIA::class, 'cuestionario_id');
    }

    public function recursosHumanos()
    {
        return $this->hasMany(CuestionarioRecursosHumanosAIA::class, 'cuestionario_id');
    }

    public function getCantidadTotalPersonasNormalAttribute()
    {
        return $this->recursosHumanos()->where('escenario', '1')->count();
    }

    public function getCantidadTotalPersonasContingenciaAttribute()
    {
        return $this->recursosHumanos()->where('escenario', '2')->count();
    }

    public function getDatosPersonasContingenciaAttribute()
    {
        return $this->recursosHumanos()->where('escenario', '2')->get()->shift();
    }

    public function getDatosPersonasContingenciaDifAttribute()
    {
        $persona_contingencia = $this->recursosHumanos()->where('escenario', '2')->get()->slice(1);

        return $persona_contingencia;
    }

    public function recursosMateriales()
    {
        return $this->hasMany(CuestionarioRecursosMaterialesAIA::class, 'cuestionario_id');
    }

    public function getCantidadEquipoComputoNormalAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '1')->pluck('equipos')->sum();
    }

    public function getCantidadTelefoniaNormalAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '1')->pluck('telefono')->sum();
    }

    public function getCantidadImpresoraNormalAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '1')->pluck('impresoras')->sum();
    }

    public function getCantidadOtrosNormalAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '1')->pluck('otro_numero')->sum();
    }

    public function getDescripcionOtrosNormalAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '2')->pluck('otro')->first();
    }

    public function getCantidadEquipoComputoContingenciaAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '2')->pluck('equipos')->sum();
    }

    public function getCantidadTelefoniaContingenciaAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '2')->pluck('telefono')->sum();
    }

    public function getCantidadImpresoraContingenciaAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '2')->pluck('impresoras')->sum();
    }

    public function getCantidadOtrosContingenciaAttribute()
    {
        return $this->recursosMateriales()->where('escenario', '2')->pluck('otro_numero')->sum();
    }

    public function getRowspanAjusteAttribute()
    {
        if ($this->cantidad_total_personas_contingencia >= 2) {
            $ajuste = $this->cantidad_total_personas_contingencia;
        } else {
            $ajuste = 1;
        }

        return $ajuste;
    }
}
