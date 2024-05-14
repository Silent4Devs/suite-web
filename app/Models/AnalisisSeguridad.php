<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AnalisisSeguridad extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'analisis_seguridad';

    protected $guarded = [
        'id',
    ];

    public function seguridad()
    {
        return $this->belongsTo(IncidentesSeguridad::class, 'seguridad_id');
    }
}
