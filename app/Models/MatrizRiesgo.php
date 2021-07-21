<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \DateTimeInterface;

/**
 * Class MatrizRiesgo
 *
 * @property int $id
 * @property string|null $amenaza
 * @property string|null $vulnerabilidad
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
 * @property int|null $activo_id
 * @property int|null $controles_id
 * @property int|null $team_id
 * @property int|null $id_analisis
 * @property int|null $id_sede
 * @property int|null $id_proceso
 * @property int|null $id_responsable
 *
 * @property Tipoactivo|null $tipoactivo
 * @property Controle|null $controle
 * @property AnalisisDeRiesgo|null $analisis_de_riesgo
 * @property Proceso|null $proceso
 * @property Empleado|null $empleado
 * @property Sede|null $sede
 * @property Team|null $team
 *
 * @package App\Models
 */
class MatrizRiesgo extends Model
{
    use SoftDeletes;
    protected $table = 'matriz_riesgos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TIPO_RIESGO_SELECT = [
        'Negativo' => 'Negativo',
        'Positivo' => 'Positivo',
    ];

    const PROBABILIDAD_SELECT = [
        'ALTA'  => 'ALTA',
        'BAJA'  => 'BAJA',
        'MEDIA' => 'MEDIA',
        'NULA'  => 'NULA',
    ];

    const IMPACTO_SELECT = [
        'MUY ALTO' => 'MUY ALTO',
        'ALTO'     => 'ALTO',
        'MEDIO'    => 'MEDIO',
        'BAJO'     => 'BAJO',
    ];

    protected $casts = [
        'nivelriesgo' => 'float',
        'riesgototal' => 'float',
        'resultadoponderacion' => 'float',
        'riesgoresidual' => 'float',
        'activo_id' => 'int',
        'controles_id' => 'int',
        'team_id' => 'int',
        'id_analisis' => 'int',
        'id_sede' => 'int',
        'id_proceso' => 'int',
        'id_responsable' => 'int'
    ];

    protected $fillable = [
        'amenaza',
        'vulnerabilidad',
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
        'riesgoresidual',
        'justificacion',
        'activo_id',
        'controles_id',
        'team_id',
        'id_analisis',
        'id_sede',
        'id_proceso',
        'id_responsable'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function tipoactivo()
    {
        return $this->belongsTo(Tipoactivo::class, 'activo_id');
    }

    public function controles()
    {
        return $this->belongsTo(Controle::class, 'controles_id');
    }

    public function analisis_de_riesgo()
    {
        return $this->belongsTo(AnalisisDeRiesgo::class, 'id_analisis');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_responsable');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
