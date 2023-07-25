<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatrizRiesgosSistemaGestion extends Model
{
    use SoftDeletes;

    protected $table = 'matriz_riesgos_sistema_gestion';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TIPO_RIESGO_SELECT = [
        '0' => 'Negativo',
        '1' => 'Positivo',
    ];

    const PROBABILIDAD_SELECT = [
        '9' => 'ALTA (9)',
        '6' => 'MEDIA (6)',
        '3' => 'BAJA (3)',
        '0' => 'NULA (0)',
    ];

    const IMPACTO_SELECT = [
        '9' => 'MUY ALTO (9)',
        '6' => 'ALTO (6)',
        '3' => 'MEDIO (3)',
        '0' => 'BAJO (0)',
    ];

    protected $casts = [
        'plan_de_accion' => 'string',
        'probabilidad_residual' => 'string',
        'impacto_residual' => 'string',
        'nivelriesgo_residual' => 'integer',
        'riesgo_total_residual' => 'string',
        'nivelriesgo' => 'float',
        'riesgototal' => 'float',
        'resultadoponderacion' => 'float',
        'riesgoresidual' => 'float',
        //'controles_id' => 'int',
        'team_id' => 'int',
        'id_analisis' => 'int',
        'id_sede' => 'int',
        'id_proceso' => 'int',
        'id_responsable' => 'int',
        'activo_id' => 'int',
        'id_amenaza' => 'int',
        'id_area' => 'int',
        'id_vulnerabilidad' => 'int',
    ];

    protected $fillable = [
        'identificador',
        'descripcionriesgo',
        'tipo_riesgo',
        'probabilidad',
        'impacto',
        'nivelriesgo',
        'riesgototal',
        'resultadoponderacion',
        'riesgoresidual',
        'justificacion',
        'team_id',
        'id_analisis',
        'id_sede',
        'id_proceso',
        'id_responsable',
        'activo_id',
        'id_amenaza',
        'id_area',
        'id_vulnerabilidad',
        'plan_de_accion',
        'probabilidad_residual',
        'impacto_residual',
        'nivelriesgo_residual',
        'riesgo_total_residual',
        'tipo_tratamiento',
        'aceptar_transferir',
        'calidad_servicio',
        'cliente',
        'estrategia_negocio',
        'disponibilidad_2000',
        'niveles_servicio',
        'continuidad_BCP',
        'confidencialidad_270000',
        'integridad_27000',
        'disponibilidad_27000',
        'resultado_ponderacion',
        'estrategia_negocioRes',
        'calidad_servicioRes',
        'clienteRes',
        'disponibilidad_2000Res',
        'niveles_servicioRes',
        'continuidad_BCPRes',
        'confidencialidad_270000Res',
        'integridad_27000Res',
        'disponibilidad_27000Res',
        'resultado_ponderacionRes',
        'riesgo_total',
        'riesgo_residual',
    ];

    /*protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }*/

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format').' '.config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function controles()
    {
        return $this->belongsTo(Controle::class, 'controles_id');
    }

    public function activo()
    {
        return $this->belongsTo(SubcategoriaActivo::class);
    }

    public function amenaza()
    {
        return $this->belongsTo(Amenaza::class, 'id_amenaza');
    }

    public function analisis_de_riesgo()
    {
        return $this->belongsTo(AnalisisDeRiesgo::class, 'id_analisis');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_responsable')->alta();
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede');
    }

    public function vulnerabilidad()
    {
        return $this->belongsTo(Vulnerabilidad::class, 'id_vulnerabilidad');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Relacion con plan de accion
    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function matriz_riesgos_controles_pivots()
    {
        return $this->belongsToMany(DeclaracionAplicabilidad::class, 'matriz_riesgos_sistema_gestion_controles_pivot', 'matriz_id', 'controles_id');
    }
}
