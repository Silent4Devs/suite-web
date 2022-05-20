<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DeclaracionAplicabilidad extends Model
{
    use HasFactory;
   
    protected static $flushCacheOnUpdate = true;
    public $table = 'declaracion_aplicabilidad';
   

    protected $fillable = [
        'control-uno',
        'control-dos',
        'anexo_indice',
        'control',
        'descripcion_control',
        'justificacion',
        'aplica',
        'aprobadores_id',
        'responsables_id',
        'estatus',
        'fecha_aprobacion',
        'created_at',
        'updated_at',
    ];

    public function getNameAttribute()
    {
        return $this->anexo_indice . ' ' . $this->nocontrolm_escenario;
    }

    public function getContentAttribute()
    {
        return Str::limit($this->anexo_politica, 50, '...') ? Str::limit($this->anexo_politica, 50, '...') : 'Sin Contenido';
    }

    public function responsables()
    {
        return $this->belongsToMany('App\Models\Empleado', 'declaracion_aplicabilidad_responsables', 'declaracion_id', 'empleado_id');
    }

    public function aprobadores()
    {
        return $this->belongsToMany('App\Models\Empleado', 'declaracion_aplicabilidad_aprobadores', 'declaracion_id', 'aprobadores_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'aprobadores_id', 'id');
    }

    public function notificacion()
    {
        return $this->hasMany(NotificacionAprobadores::class, 'declaracion_id', 'id');
    }

    public function control()
    {
        return $this->belongsTo(self::class, 'anexo_indice', 'id', 'anexo_politica');
    }
}
