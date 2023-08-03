<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class EvaluacionServicio extends Model implements Auditable
{
    public $table = 'evaluacion_servicio';

    use HasFactory, softDeletes;
    use AuditableTrait;

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'servicio_id',
        'fecha',
        'evaluacion',
        'evaluacion_day',
        'promedio',
        'created_by',
        'updated_by',
    ];
}
