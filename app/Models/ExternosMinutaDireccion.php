<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExternosMinutaDireccion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
