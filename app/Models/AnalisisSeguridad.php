<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnalisisSeguridad extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'analisis_seguridad';

    protected $guarded = [
        'id',
    ];

    public function seguridad()
    {
        return $this->belongsTo(IncidentesSeguridad::class, 'seguridad_id');
    }
}
