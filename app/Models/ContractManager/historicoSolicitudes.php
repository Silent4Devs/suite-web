<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class historicoSolicitudes extends Model implements Auditable
{
    // use SoftDeletes;
    use ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'historico_solicitudes';

    protected $casts = [
        'historico' => 'string',
    ];

    protected $fillable = [
        'historico',
        'solicitud_id',

    ];

    public function solicitudes()
    {
        return $this->hasMany(solicitudes::class, 'solicitud_id');
    }
}
