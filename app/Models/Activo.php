<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Activo extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'activos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tipoactivo_id',
        'subtipo_id',
        'descripcion',
        'dueno_id',
        'ubicacion_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

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

    public function subtipo()
    {
        return $this->belongsTo(Tipoactivo::class, 'subtipo_id');
    }

    public function dueno()
    {
        return $this->belongsTo(User::class, 'dueno_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Sede::class, 'ubicacion_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
