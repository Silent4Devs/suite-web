<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanaccionCorrectiva extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'planaccion_correctivas';

    public static $searchable = [
        'actividad',
    ];

    protected $dates = [
        'fechacompromiso',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ESTATUS_SELECT = [
        'por_iniciar' => 'Por iniciar',
        'en_proceso' => 'En proceso',
        'terminado' => 'Terminado',
    ];

    protected $fillable = [
        'accioncorrectiva_id',
        'actividad',
        'responsable_id',
        'fechacompromiso',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /*
        public function accioncorrectiva()
        {
            return $this->belongsTo(AccionCorrectiva::class, 'accioncorrectiva_id');
        }
    */
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function getFechacompromisoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechacompromisoAttribute($value)
    {
        $this->attributes['fechacompromiso'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
