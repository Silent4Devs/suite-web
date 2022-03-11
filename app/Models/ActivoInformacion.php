<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ActivoInformacion extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'activos_informacion';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
    'identificador',
    'nombreVP',
    'duenoVP',
    'nombre_direccion',
    'custodioALDirector',
    'activo_informacion',
    'formato',
    'proceso_id',
    'creacion',
    'recepcion',
    'otra_recepcion',
    'uso_digital',
    'nombre_aplicacion',
    'carpeta_compartida',
    'otra_AppCarpeta',
    'uso_fisico',
    'otro',
    'imprime',
    'direccion_envio',
    'vp_envio',
    'envio_digital',
    'otro_envio_digital',
    'informacion_total',
    'proveedor_envio',
    'envio_ext',
    'otro_envioExt',
    'informacion_totalExt',
    'acceso_informacionExt',
    'requiere_info',
    'almacenamiento_digital',
    'almacenamiento_aplicacion',
    'carpeta_compartida_almacenamiento',
    'otra_AppCarpeta_almacenamiento',
    'almacenamiento_fisico',
    'otro_almacenamiento_fisico',
    'ubicacion_fisica',
    'almacenamiento_acceso',
    'acceso_requerido',
    'tiempo_almacenamiento',
    'destruye',
    'eliminacion_digital',
    'otro_eliminacion',
    'eliminacion_fisica',
    'question',
    'question_1',
    'question_2',
    'question_3',
    'question_4',
    'question_5',
    'question_6',
    'question_7',
    'confidencialidad_id',
    'integridad_id',
    'disponibilidad_id',
    'valor_criticidad',
    'created_at',
    'updated_at',
    'deleted_at',
    ];

    public function dueno()
    {
        return $this->belongsTo(Empleado::class, 'duenoVP', 'id');
    }

    public function custodio()
    {
        return $this->belongsTo(Empleado::class, 'custodioALDirector', 'id');
    }
    public function direccion()
    {
        return $this->belongsTo(Area::class, 'nombre_direccion', 'id');
    }

    public function proceso()
    {
        return $this->belongsTo(Empleado::class, 'proceso_id', 'id');
    }
    public function confidencialidad()
    {
        return $this->belongsTo(activoConfidencialidad::class, 'confidencialidad_id', 'id');
    }
    public function integridad()
    {
        return $this->belongsTo(activoIntegridad::class, 'integridad_id', 'id');
    }
    public function disponibilidad()
    {
        return $this->belongsTo(activoDisponibilidad::class, 'disponibilidad_id', 'id');
    }
}
