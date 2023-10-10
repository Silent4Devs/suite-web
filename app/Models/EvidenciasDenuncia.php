<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EvidenciasDenuncia extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
