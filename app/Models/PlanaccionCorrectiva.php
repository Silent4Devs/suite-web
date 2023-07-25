<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanaccionCorrectiva extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

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
