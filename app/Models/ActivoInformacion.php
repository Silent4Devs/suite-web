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
    public $table = 'activosInformacion';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'identificador',
        'nombreVP',
        'duenoVP',
        'nombreDireccion',
        'custodioAIDirector',
        'activoInformacion',
        'formato',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_responsable', 'id');
    }
}
