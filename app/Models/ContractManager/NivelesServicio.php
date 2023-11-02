<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NivelesServicio extends Model implements Auditable
{
    use HasFactory, softDeletes, ClearsResponseCache;
    use AuditableTrait;

    public $table = 'niveles_servicio';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'contrato_id',
        'nombre',
        'metrica',
        'meta',
        'unidad',
        'info_consulta',
        'periodo_evaluacion',
        'revisiones',
        'area',
        'descripcion',
        'created_by',
        'updated_by',
    ];
}
