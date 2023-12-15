<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Comiteseguridad extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, MultiTenantModelTrait, SoftDeletes;

    public $table = 'comite_seguridad';

    protected $fillable = [
        'nombre_comite',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function getAll()
    {
        return Cache::remember('comite_seguridad_all', 3600 * 6, function () {
            return self::get();
        });
    }

    public function miembros()
    {
        return $this->belongsToMany(Empleado::class, 'miembros_comite_seguridad', 'comite_id', 'id_asignada')->alta()->with('area');
    }
}
