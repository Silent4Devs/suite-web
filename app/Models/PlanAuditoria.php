<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanAuditoria extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
