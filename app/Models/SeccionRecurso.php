<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeccionRecurso extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'lecciones_recursos';

    protected $fillable = [
        'name',
        'recurso_id',
    ];

    public function lecciones()
    {
        return $this->hasMany(LeccionRecurso::class, 'seccion_id', 'id');
    }

    public function capacitacion()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id', 'id');
    }
}
