<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class MatrizRiesgo extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'matriz_riesgos';

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

    protected $fillable = [
        'proceso',
        'activo_id',
        'responsableproceso',
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
        'controles_id',
        'justificacion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
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

    public function activo()
    {
        return $this->belongsTo(Activo::class, 'activo_id');
    }

    public function controles()
    {
        return $this->belongsTo(Controle::class, 'controles_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
