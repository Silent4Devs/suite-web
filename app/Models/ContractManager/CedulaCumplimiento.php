<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class CedulaCumplimiento extends Model implements Auditable
{
    use AuditableTrait;
    use ClearsResponseCache, HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'cedula_cumplimiento';

    protected $fillable = [
        'contrato_id',
        'elaboro',
        'reviso',
        'autorizo',
        'cumple',
    ];

    protected $casts = [
        'cumple' => 'boolean',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
