<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PlanAuditoria extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $table = 'plan_auditoria';

    protected $fillable = [
        'objetivo',
        'alcance',
        'criterios',
        'documentoauditar',
        'equipoauditor',
        'descripcion',
        'fecha_auditoria',
        'fecha_inicio_auditoria',
        'fecha_fin_auditoria',
    ];
}
