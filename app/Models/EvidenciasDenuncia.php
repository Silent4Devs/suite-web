<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvidenciasDenuncia extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'evidencias_denuncias';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_denuncias' => 'int',
        'evidencia' => 'string',
    ];

    protected $fillable = [
        'id_denuncias',
        'evidencia',
    ];

    public function denuncias()
    {
        return $this->belongsTo(Denuncias::class, 'id_denuncias');
    }
}
