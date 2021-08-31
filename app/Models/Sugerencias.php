<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugerencias extends Model
{
    use HasFactory;

    protected $table = 'sugerencias';

    protected $guarded = [
        'id'
    ];

    protected $appends = ['folio'];

    public function getFolioAttribute()
    {
        return  sprintf('SUG-%04d', $this->id);
    }

    public function sugirio()
    {
        return $this->belongsTo(Empleado::class, 'empleado_sugirio_id', 'id');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadSugerencia::class, 'sugerencia_id', 'id');
    }
}
