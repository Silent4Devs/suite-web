<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class IndicadoresSgsi extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'indicadores_sgsis';

    public static $searchable = [
        'control',
        'titulo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const UNIDADMEDIDA_SELECT = [
        'porcentaje' => 'Porcentaje',
        'numeventos' => 'Numero eventos',
    ];

    const SEMAFORO_SELECT = [
        'verde'    => 'Verde',
        'amarillo' => 'Amarillo',
        'rojo'     => 'Rojo',
    ];

    const FRECUENCIA_SELECT = [
        'mensual'       => 'Mensual',
        'bimestral'     => 'Bimestral',
        'trimestral'    => 'Trimestral',
        'cuatrimestral' => 'Cuatrimestral',
        'semestral'     => 'Semestral',
        'anual'         => 'Anual',
    ];

    protected $fillable = [
        'control',
        'titulo',
        'responsable_id',
        'formula',
        'frecuencia',
        'unidadmedida',
        'meta',
        'semaforo',
        'enero',
        'febrero',
        'marzo',
        'abril',
        'mayo',
        'junio',
        'julio',
        'agosto',
        'septiembre',
        'octubre',
        'noviembre',
        'diciembre',
        'anio',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
