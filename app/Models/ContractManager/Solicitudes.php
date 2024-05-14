<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Solicitudes extends Model implements Auditable
{
    use AuditableTrait;
    use ClearsResponseCache, HasFactory, SoftDeletes;

    public $table = 'solicitudes';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    /*protected $dispatchesEvents= [
        'created' => ProveedorCreated::class,
    ];*/

    protected $fillable = [
        'tipo_id',
        'folio',
        'nombre',
        'solicitante_id',
        'descripcion',
        'fecha_solicitud',
        'asignado_id',
        'area_id',
        // 'aprobador_id',
        'proveedor_id',
        'informacion',
        'plantilla_id',
        'plantilla_contenido',
        'comentarios_asignado',
        'comentarios_solicitante',
        'comentarios_rechazado',
        'contrato_generado_id',
        'estado',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'area_id' => 'string',
        'fecha_solicitud' => 'date',
        'estado' => 'string',
    ];

    public function solicitante()
    {
        return $this->belongsTo(User::class, 'solicitante_id');
    }

    public function asignado()
    {
        return $this->belongsTo(User::class, 'asignado_id');
    }

    public function aprobador()
    {
        return $this->belongsTo(User::class, 'aprobador_id');
    }

    public function plantilla()
    {
        return $this->belongsTo(plantilla::class, 'plantilla_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
