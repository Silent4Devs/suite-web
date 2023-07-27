<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MatrizRequisitoLegale extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'matriz_requisito_legales';

    public static $searchable = [
        'nombrerequisito',
    ];

    const PERIODICIDAD_SELECT = [
        'Diaria' => 'Diaria',
        'Semanal' => 'Semanal',
        'Catorcenal' => 'Catorcenal',
        'Quincenal' => 'Quincenal',
        'Mensual' => 'Mensual',
        'Bimestral' => 'Bimestral',
        'Trimestral' => 'Trimestral',
        'Semestral' => 'Semestral',
        'Anual' => 'Anual',
        'Multianual' => 'Multianual',
        'Permanente' => 'Permanente',
        'Única vez' => 'Única vez',
    ];

    const TIPO_SELECT = [
        'Legal' => 'Legal',
        'Normativo' => 'Normativo',
        'Regulatorio' => 'Regulatorio',
        'Contractual' => 'Contractual',
        'Otro' => 'Otro',

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
        'medio',
        'tipo',
        'descripcion_cumplimiento',
        'evidencia',
        'id_reviso',
        'alcance',
        'metodo',
        'comentarios',
        'cumplimiento_organizacion',
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
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    // public function setFechaexpedicionAttribute($value)
    // {
    //     $this->attributes['fechaexpedicion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function getFechavigorAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    // public function setFechavigorAttribute($value)
    // {
    //     $this->attributes['fechavigor'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function getFechaverificacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    // public function setFechaverificacionAttribute($value)
    // {
    //     $this->attributes['fechaverificacion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_reviso', 'id')->alta()->with('area');
    }

    public function evidencias_matriz()
    {
        return $this->hasMany(EvidenciaMatrizRequisitoLegale::class, 'id_matriz_requisito');
    }

    // Relacion con plan de accion
    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function evaluaciones()
    {
        return $this->hasMany(EvaluacionRequisitoLegal::class, 'id_matriz', 'id')->orderByDesc('fechaverificacion');
    }
}
