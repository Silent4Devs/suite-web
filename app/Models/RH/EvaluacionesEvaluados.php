<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EvaluacionesEvaluados extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'ev360_evaluaciones_evaluados';

    protected $fillable = [
        'id',
        'evaluacion_id',
        'evaluado_id',
        'created_at',
        'updated_at',
        'puesto_id',
    ];
}
