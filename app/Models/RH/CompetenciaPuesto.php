<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CompetenciaPuesto extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
