<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Activo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $table = 'activos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tipoactivo_id',
        'proceso_id',
        'identificador',
        'subtipo_id',
        'nombreactivo',
        'descripcion',
        'dueno_id',
        'ubicacion_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'marca',
        'modelo',
        'n_serie',
        'n_producto',
        'fecha_fin',
        'fecha_compra',
        'id_responsable',
        'observaciones',
        'fecha_baja',
        'fecha_alta',
        'sede',
        'documentos_relacionados',
        'documento',
    ];

    protected $casts = [

        'modelo' => 'int',
        'marca' => 'int',
    ];

    // Redis methods
    public static function getAll()
    {
        return Cache::remember('Activos:activos_all', 3600 * 7, function () {
            return self::get();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function activoIncidentesDeSeguridads()
    {
        return $this->belongsToMany(IncidentesDeSeguridad::class);
    }

    public function tipoactivo()
    {
        return $this->belongsTo(Tipoactivo::class, 'tipoactivo_id');
    }

    // public function subtipo()
    // {
    //     return $this->belongsTo(SubcategoriaActivo::class, 'subtipo_id');
    // }

    public function dueno()
    {
        return $this->belongsTo(Empleado::class, 'dueno_id')->alta();
    }

    public function ubicacion()
    {
        return $this->belongsTo(Sede::class, 'ubicacion_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_responsable', 'id')->alta();
    }

    public function proceso()
    {
        return $this->belongsTo(Empleado::class, 'proceso_id', 'id')->alta();
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca', 'id');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo', 'id');
    }

    public function documento_activo()
    {
        return $this->hasMany(DocumentoActivo::class, 'activo_id', 'id');
    }

    public function subtipo()
    {
        return $this->hasMany(SubcategoriaActivo::class, 'subcategoria', 'id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(SubcategoriaActivo::class, 'subtipo_id');
    }
}
