<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EvaluacionObjetivo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'ev360_evaluacion_objetivos';

    protected $guarded = ['id'];

    public function objetivo()
    {
        return $this->belongsTo('App\Models\RH\Objetivo', 'objetivo_id', 'id');
    }
}
