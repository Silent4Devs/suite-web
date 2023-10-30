<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RangosResultado extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'ev360_rangos_resultados';

    protected $fillable = [
        'inaceptable',
        'minimo_aceptable',
        'aceptable',
        'sobresaliente',
        'evaluacion_id',
    ];

    protected $casts = [
        'inaceptable' => 'integer',
        'minimo_aceptable' => 'integer',
        'aceptable' => 'integer',
        'sobresaliente' => 'integer',
        'evaluacion_id' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'evaluacion_id');
    }
}
