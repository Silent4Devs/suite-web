<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EvaluacionCompetencia extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'ev360_competencia_evaluacion';

    protected $guarded = ['id'];

    public function competencia()
    {
        return $this->belongsTo('App\Models\RH\Competencia', 'competencia_id', 'id');
    }
}
