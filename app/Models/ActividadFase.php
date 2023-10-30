<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActividadFase extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $dates = ['deleted_at'];

    protected $table = 'actividad_fases';

    protected $fillable = ['fase_nombre'];

    public function plan_base_actividades()
    {
        return $this->hasMany(PlanBaseActividade::class, 'actividad_fase_id', 'id');
    }
}
