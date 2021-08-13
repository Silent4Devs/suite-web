<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class MatrizRequisitoLegale extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'matriz_requisito_legales';

    public static $searchable = [
        'nombrerequisito',
    ];

    const CUMPLEREQUISITO_SELECT = [
        'Si' => 'Si',
        'No' => 'No',
    ];

    protected $dates = [
        'fechaexpedicion',
        'fechavigor',
        'fechaverificacion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombrerequisito',
        'fechaexpedicion',
        'fechavigor',
        'requisitoacumplir',
        'cumplerequisito',
        'formacumple',
        'periodicidad_cumplimiento',
        'fechaverificacion',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFechaexpedicionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaexpedicionAttribute($value)
    {
        $this->attributes['fechaexpedicion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFechavigorAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechavigorAttribute($value)
    {
        $this->attributes['fechavigor'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFechaverificacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaverificacionAttribute($value)
    {
        $this->attributes['fechaverificacion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // Relacion con plan de accion
    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }
}
