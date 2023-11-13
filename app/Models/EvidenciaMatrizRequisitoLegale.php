<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciaMatrizRequisitoLegale extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'evidencias_matriz_requisito_legales';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_matriz_requisito' => 'int',
        'evidencia' => 'string',

    ];

    protected $fillable = [
        'id_matriz_requisito',
        'evidencia',
        'id_evaluacion',

    ];

    public function matriz_requisito()
    {
        return $this->belongsTo(MatrizRequisitoLegale::class, 'id_matriz_requisito');
    }
}
