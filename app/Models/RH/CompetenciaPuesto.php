<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaPuesto extends Model
{
    use HasFactory;
    // public $cacheFor = 3600;
    // protected static $flushCacheOnUpdate = true;

    protected $table = 'ev360_competencias_por_puesto';

    protected $fillable = [
        'competencia_id',
        'puesto_id',
        'nivel_esperado',
    ];

    public function competencia()
    {
        return $this->belongsTo('App\Models\RH\Competencia', 'competencia_id', 'id');
    }

    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto', 'puesto_id', 'id')->with('area');
    }
}
