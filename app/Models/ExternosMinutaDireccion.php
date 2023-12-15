<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ExternosMinutaDireccion extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'externos_minuta_alta_direcccion';

    protected $fillable = [
        'nombreEXT',
        'emailEXT',
        'puestoEXT',
        'empresaEXT',
        'minuta_id',
    ];

    public function revision()
    {
        return $this->belongsTo(MinutasAltaDireccion::class, 'minuta_id');
    }
}
