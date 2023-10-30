<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluacionServicio extends Model implements Auditable
{
    public $table = 'evaluacion_servicio';

    use HasFactory, softDeletes, ClearsResponseCache;
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
