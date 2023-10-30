<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;

class historicoSolicitudes extends Model
{
    // use SoftDeletes;
    use ClearsResponseCache;

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
