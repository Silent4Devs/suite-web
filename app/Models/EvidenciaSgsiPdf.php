<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciaSgsiPdf extends Model
{
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
