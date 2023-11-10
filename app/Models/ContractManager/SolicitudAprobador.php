<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudAprobador extends Model
{
    use ClearsResponseCache, HasFactory;

    public $table = 'solicitudes_aprobadores';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'solicitud_id',
        'usuario_id',
        'estatus',
        'created_by',
        'updated_by',
    ];

    public function aprobador()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
