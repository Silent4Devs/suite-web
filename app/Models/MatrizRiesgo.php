<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class MatrizRiesgo.
 *
 * @property int $id
 * @property string|null $descripcionriesgo
 * @property string|null $tipo_riesgo
 * @property string|null $confidencialidad
 * @property string|null $integridad
 * @property string|null $disponibilidad
 * @property string|null $probabilidad
 * @property string|null $impacto
 * @property float|null $nivelriesgo
 * @property float|null $riesgototal
 * @property float|null $resultadoponderacion
 * @property float|null $riesgoresidual
 * @property string|null $justificacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $controles_id
 * @property int|null $team_id
 * @property int|null $id_analisis
 * @property int|null $id_sede
 * @property int|null $id_proceso
 * @property int|null $id_responsable
 * @property int|null $activo_id
 * @property int|null $id_amenaza
 * @property int|null $id_area
 * @property int|null $id_vulnerabilidad
 * @property string|null $plan_de_accion
 * @property string|null $confidencialidad_cid
 * @property string|null $integridad_cid
 * @property string|null $disponibilidad_cid
 * @property string|null $probabilidad_residual
 * @property string|null $impacto_residual
 * @property string|null $nivelriesgo_residual
 * @property string|null $riesgo_total_residual
 * @property Controle|null $controle
 * @property Activo|null $activo
 * @property Amenaza|null $amenaza
 * @property AnalisisDeRiesgo|null $analisis_de_riesgo
 * @property Area|null $area
 * @property Proceso|null $proceso
 * @property Empleado|null $empleado
 * @property Sede|null $sede
 * @property Vulnerabilidad|null $vulnerabilidad
 * @property Team|null $team
 * @property Collection|MatrizRiesgosControlesPivot[] $matriz_riesgos_controles_pivots
 */
class MatrizRiesgo extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'matriz_riesgos';

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

    const PROBABILIDAD27000_SELECT = [
        '5' => 'MUY ALTA (5)',
        '4' => 'ALTA (4)',
        '3' => 'MODERADA (3)',
        '2' => 'BAJA (2)',
        '1' => 'MUY BAJA (1)',
    ];

    const IMPACTO27000_SELECT = [
        '5' => 'SIGNIFICATIVO (5)',
        '4' => 'MAYOR (4)',
        '3' => 'IMPORTANTE (3)',
        '2' => 'BAJO (2)',
        '1' => 'MENOR (1)',
    ];

    const IMPACTO_SELECT = [
        '9' => 'MUY ALTO (9)',
        '6' => 'ALTO (6)',
        '3' => 'MEDIO (3)',
        '0' => 'BAJO (0)',
    ];

    const EV_INICIAL_SELECT = [
        '11.1' => 'Sí',
        '0' => 'No',
    ];

    const TIPO_TRATAMIENTO_SELECT = [
        '1' => 'Aceptar',
        '0' => 'Mitigar',
        '2' => 'transferir',
    ];

    protected $casts = [
        'plan_de_accion' => 'string',
        'confidencialidad_cid' => 'string',
        'integridad_cid' => 'string',
        'disponibilidad_cid' => 'string',
        'probabilidad_residual' => 'string',
        'impacto_residual' => 'string',
        'nivelriesgo_residual' => 'string',
        'riesgo_total_residual' => 'string',
        'nivelriesgo' => 'float',
        'riesgototal' => 'float',
        'resultadoponderacion' => 'float',
        'resultadoponderacionRes' => 'float',
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
        'version_historico' => 'boolean',
    ];

    protected $fillable = [
        'descripcionriesgo',
        'tipo_riesgo',
        'confidencialidad',
        'integridad',
        'disponibilidad',
        'probabilidad',
        'impacto',
        'nivelriesgo',
        'riesgototal',
        'resultadoponderacion',
        'resultadoponderacionRes',
        'riesgoresidual',
        'justificacion',
        //'controles_id',
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
        'confidencialidad_cid',
        'integridad_cid',
        'disponibilidad_cid',
        'probabilidad_residual',
        'impacto_residual',
        'nivelriesgo_residual',
        'riesgo_total_residual',
        'tipo_tratamiento',
        'aceptar_transferir',
        'version_historico',
    ];

    /*protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }*/

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
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
        return $this->belongsToMany(DeclaracionAplicabilidad::class, 'matriz_riesgos_controles_pivot', 'matriz_id', 'controles_id');
    }
}
