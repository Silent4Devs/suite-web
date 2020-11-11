<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Sede extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'sedes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sede',
        'descripcion',
        'organizacion_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'organizacion_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
