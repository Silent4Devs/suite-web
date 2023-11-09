<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciaSgsiPdf extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
