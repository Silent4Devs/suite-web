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
    public function proceso()
    {
        return $this->belongsTo(Empleado::class, 'proceso_id', 'id');
    }



}
