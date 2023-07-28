<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Comiteseguridad extends Model implements Auditable
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'comite_seguridad';

    protected $fillable = [
        'nombre_comite',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function miembros()
    {
        return $this->belongsToMany(Empleado::class, 'miembros_comite_seguridad', 'comite_id', 'id_asignada')->alta()->with('area');
    }
}
