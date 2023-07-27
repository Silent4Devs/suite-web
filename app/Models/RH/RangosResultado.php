<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RangosResultado extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

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
