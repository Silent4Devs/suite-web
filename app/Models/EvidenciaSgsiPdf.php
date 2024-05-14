<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EvidenciaSgsiPdf extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'evidencias_evidencias_sgsis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_evidencias_sgsis' => 'int',
        'evidencia' => 'string',

    ];

    protected $fillable = [
        'id_evidencias_sgsis',
        'evidencia',

    ];

    public function evidencia_sgsi()
    {
        return $this->belongsTo(EvidenciasSgsi::class, 'id_evidencias_sgsis');
    }
}
