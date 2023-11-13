<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluacionesEvaluados extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
