<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Evaluacion extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $table = 'ev360_evaluaciones';

    protected $guarded = ['id'];

    protected $appends = ['estatus_formateado', 'color_estatus', 'color_estatus_text'];

    protected $casts = [
        'fecha_inicio' => 'date:d-m-Y',
        'fecha_fin' => 'date:d-m-Y',
    ];

    const DRAFT = '1';

    const ACTIVE = '2';

    const CLOSED = '3';

    const TODA_LA_EMPRESA = '0';

    const GRUPO_DINAMICO = '3';

    const POR_AREA = '1';

    const SELECCION_MANUAL = '2';

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('Evaluacion_all', 3600 * 24, function () {
            return self::get();
        });
    }

    public function getEstatusFormateadoAttribute()
    {
        switch ($this->estatus) {
            case strval($this::DRAFT):
                return 'Draft';
                break;
            case strval($this::ACTIVE):
                return 'Activo';
                break;
            case strval($this::CLOSED):
                return 'Cerrado';
                break;
            default:
                return 'Draft';
                break;
        }
    }

    public function getColorEstatusAttribute()
    {
        switch ($this->estatus) {
            case strval($this::DRAFT):
                return '#d2c7ff';
                break;
            case strval($this::ACTIVE):
                return '#10C639';
                break;
            case strval($this::CLOSED):
                return '#1068C6';
                break;
            default:
                return '#d2c7ff';
                break;
        }
    }

    public function getColorEstatusTextAttribute()
    {
        switch ($this->estatus) {
            case strval($this::DRAFT):
                return '#000';
                break;
            case strval($this::ACTIVE):
                return '#fff';
                break;
            case strval($this::CLOSED):
                return '#fff';
                break;
            default:
                return '#000';
                break;
        }
    }

    public function evaluados()
    {
        return $this->belongsToMany('App\Models\Empleado', 'ev360_evaluaciones_evaluados', 'evaluacion_id', 'evaluado_id')->withPivot('puesto_id');
    }

    public function competencias()
    {
        return $this->belongsToMany('App\Models\RH\Competencia', 'ev360_competencia_evaluacion', 'evaluacion_id', 'competencia_id');
    }

    public function objetivos()
    {
        return $this->belongsToMany('App\Models\RH\Objetivo', 'ev360_evaluacion_objetivos', 'evaluacion_id', 'objetivo_id');
    }

    public function autor()
    {
        return $this->belongsTo('App\Models\Empleado', 'autor_id', 'id');
    }
}
