<?php

namespace App\Models\Katbol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Proveedores extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    public $table = 'proveedores';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    /*protected $dispatchesEvents= [
        'created' => ProveedorCreated::class,
    ];*/

    protected $fillable = [
        'razon_social',
        'nombre_comercial',
        'rfc',
        'calle',
        'colonia',
        'ciudad',
        'codigo_postal',
        'telefono',
        'pagina_web',
        'nombre_completo',
        'puesto',
        'correo',
        'celular',
        'objeto_descripcion',
        'cobertura',
        'id_fiscale',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'razon_social' => 'string',
        'nombre_comercial' => 'string',
        'rfc' => 'string',
        'calle' => 'string',
        'colonia' => 'string',
        'ciudad' => 'string',
        'codigo_postal' => 'string',
        'telefono' => 'integer',
        'pagina_web' => 'string',
        'nombre_completo' => 'string',
        'puesto' => 'string',
        'correo' => 'string',
        'celular' => 'integer',
        'objeto_descripcion' => 'string',
        'cobertura' => 'string',

    ];

    public function solicitud()
    {
        return $this->hasMany(Solicitudes::class, 'proveedor_id');
    }

    public function fiscale()
    {
        return $this->belongsTo(Fiscale::class, 'id_fiscale');
    }
}
